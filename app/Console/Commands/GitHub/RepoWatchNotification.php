<?php

namespace App\Console\Commands\GitHub;

use App\Notifications\Telegram\HtmlText;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\RepoWatch;
use Illuminate\Support\Facades\Notification;

class RepoWatchNotification extends Command
{
    protected string $gitHubUrl = 'https://github.com/:package';
    protected string $gitHubApiUrl = 'https://api.github.com/repos/:package/releases/latest';
    protected Client $client;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repo:watch {--silent}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify about new release of repositories';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $silent = $this->option('silent');

        $repos = RepoWatch::all();
        $this->client = new Client();

        $updates = [];

        foreach ($repos as $repo) {
            $version = $this->getCurrentVersion($repo->name);
            if ($version != $repo->version) {
                if (!$silent) {
                    $updates[] = __($this->gitHubUrl, ['package' => $repo->name]).' ['.$version.']';
                }
                $repo->update(['version' => $version]);
            }
        }

        if (!$silent && count($updates)) {
            $count = count($updates);
            $content = trans_choice('There is one repository update|There are :count repository updates', $count, ['count' => $count])."\n";
            $content.= implode("\n", $updates);
            Notification::send(config('services.telegram-bot-api.receiver'), new HtmlText($content, true));
        }

        return 0;
    }

    protected function getCurrentVersion(string $repository): string
    {
        $response = $this->client->request('GET' ,__($this->gitHubApiUrl, ['package' => $repository]), [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/vnd.github.v3+json',
            ],
        ]);

        $content = json_decode($response->getBody()->getContents(), true);

        return !empty($content['name']) ? $content['name'] : $content['tag_name'];
    }
}
