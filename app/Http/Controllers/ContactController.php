<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Notifications\Telegram\HtmlText;
use App\Rules\Honeypot;
use App\Rules\NoTrashMail;
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
        $request->validate([
            'name'         => ['string', 'required'],
            'subject'      => ['string', 'required'],
            'message'      => ['string', 'required'],
            'email'        => ['required', 'email', 'confirmed', new NoTrashMail],
            'confirmation' => [new Honeypot],
        ]);

        ContactRequest::create($request->all());

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
