<?php

namespace App\Http\Controllers;

use App\Notifications\Telegram\HtmlText;
use App\Rules\Honeypot;
use App\Rules\NoTrashMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\ContactRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Response as HttpResponse;

class ContactController extends Controller
{
    /**
     * @param Request $request
     * @return HttpResponse
     */
    public function store(Request $request): HttpResponse
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

        return response('created', Response::HTTP_CREATED);
    }
}
