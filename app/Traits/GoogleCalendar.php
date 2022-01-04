<?php


namespace App\Traits;


use Google\Client;
use Google\Exception;
use Google_Service_Calendar;

trait GoogleCalendar
{
    protected Client $googleClient;

    /**
     * @throws Exception
     */
    protected function googleCalendarInit()
    {
        $this->googleClient = new Client;

        $this->googleClient->setAuthConfig(config('services.google.credentials-file'));
        $this->googleClient->addScope(Google_Service_Calendar::CALENDAR);
        $this->googleClient->addScope(Google_Service_Calendar::CALENDAR_EVENTS);
        $this->googleClient->setRedirectUri(route('auth.google.callback'));
        $this->googleClient->setAccessType('offline');
        $this->googleClient->setIncludeGrantedScopes(true);
        $this->googleClient->setApprovalPrompt('force');
    }
}
