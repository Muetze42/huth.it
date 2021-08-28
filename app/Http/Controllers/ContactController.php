<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Notifications\Telegram\HtmlText;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\TrashMail;
use App\Models\ContactRequest;
use Egulias\EmailValidator\EmailValidator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Http\Response as HttpResponse;

class ContactController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Contact/Index');
    }

    /**
     * @param Request $request
     * @return HttpResponse|Application|ResponseFactory
     */
    public function store(Request $request): HttpResponse|Application|ResponseFactory
    {
        // Todo : Create Validator with correct response

        $subject = $request->input('subject');
        $message = $request->input('message');
        $email = $request->input('email');
        $email2 = $request->input('confirm');
        $name = $request->input('name');
        $confirmation = $request->input('confirmation');

        if ($confirmation) {
            return $this->returnError(__('Who has been nibbling at the honey pot?'));
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->returnError(__('This is not a valid email address'));
        }
        if ($email != $email2) {
            return $this->returnError(__('The 2 mail addresses do not match'));
        }
        $mailValidator = new EmailValidator();
        if (!$mailValidator->isValid($email, new DNSCheckValidation())) {
            return $this->returnError(__('This email is not reachable'));
        }
        if (TrashMail::where('provider', explode('@', $email)[1])->first()) {
            return $this->returnError(__('This email provider is not allowed'));
        }

        ContactRequest::create([
            'subject' => $subject,
            'message' => $message,
            'email'   => $email,
            'name'    => $name,
        ]);

        Notification::send(config('services.telegram-bot-api.receiver'), new HtmlText(__('New message on :site', ['site' => config('app.url')])));

        return response('created', ResponseAlias::HTTP_CREATED);
    }

    /**
     * @param string $message
     * @return HttpResponse|Application|ResponseFactory
     */
    protected function returnError(string $message): HttpResponse|Application|ResponseFactory
    {
        return response($message, ResponseAlias::HTTP_MISDIRECTED_REQUEST);
    }
}
