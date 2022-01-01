<?php

namespace App\Http\Controllers\Api;

use App\Models\Repository;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\GithubWebhook as Webhook;
use Illuminate\Http\JsonResponse;
use App\Notifications\Telegram\Webhook as TelegramNotification;
use Illuminate\Support\Facades\Log;

class GitHubWebhookController extends Controller
{
    protected Webhook $webhook;
    protected string $event;

    /**
     * @param Request $request
     * @param Webhook $webhook
     * @param string $slug
     * @return JsonResponse
     */
    public function index(Request $request, Webhook $webhook, string $slug): JsonResponse
    {
        if ($webhook->slug != $slug) {
            return jsonResponse();
        }

        $payload = $request->getContent();

        if ($webhook->secret) {
            $signature = str_replace('sha256=', '', $request->header('X-Hub-Signature-256'));
            $expectedSignature = hash_hmac('sha256', $payload, $webhook->secret);

            if ($signature != $expectedSignature) {
                return jsonResponse('Wrong secret', 401);
            }
        }

        $this->webhook = $webhook;
        $this->event = $request->header('x-github-event');

        $contentTyp = $request->header('content-type');
        return match ($contentTyp) {
            'application/json' => $this->handlePayload($payload),
            'application/x-www-form-urlencoded' => $this->handlePayload($request->input('payload')),
            default => jsonResponse('Not supported `content-type`', 400),
        };
    }

    /**
     * @param $payload
     * @return JsonResponse
     */
    protected function handlePayload($payload): JsonResponse
    {
        $content = json_decode($payload);

        if ($this->event == $this->webhook->event) {
            $branch = basename($content->ref);

            if ($this->checkBranch($branch)) {
                $action = $content->action ?? null;
                if ($this->checkActions($action)) {
                    $replace = [
                        '{repoName}'   => $content->repository->name,
                        '{repoUrl}'    => $content->repository->html_url,
                        '{repoVendor}' => $content->repository->owner->name,
                        '{branch}'     => $branch,
                        '{causerName}' => $content->sender->login,
                        '{causerId}'   => $content->sender->id,
                    ];

                    $message = preg_replace('/`(.*?)`/', '<code>$1</code>', e($this->webhook->message));
                    $message = str_replace(array_keys($replace), array_values($replace), $message);

                    if (!empty($content->after)) {
                        $repo = Repository::where([
                            'package' => $content->repository->name,
                            'branch'  => $branch,
                        ])->first();

                        $repo?->update(['reference' => $content->after]);
                    }

                    foreach ($this->webhook->telegramReceivers as $receiver) {
                        $receiver->notify(new TelegramNotification($message));
                    }
                }
            }
        }

        return jsonResponse('Ok', 200);
    }

    /**
     * @param string|null $action
     * @return bool
     */
    protected function checkActions(?string $action): bool
    {
        if(!$action || !$this->webhook->actions) {
            return true;
        }

        return isset($this->webhook->actions[$action]) && $this->webhook->actions[$action];
    }

    /**
     * @param string $branch
     * @return bool
     */
    protected function checkBranch(string $branch): bool
    {
        if(!$this->webhook->branches || empty($this->webhook->branches)) {
            return true;
        }
        $branches = (array) $this->webhook->branches;

        return in_array($branch, $branches);
    }
}
