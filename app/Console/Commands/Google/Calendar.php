<?php

namespace App\Console\Commands\Google;

use App\Models\User;
use App\Notifications\Telegram\HtmlText;
use App\Traits\GoogleCalendar;
use Google\Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class Calendar extends Command
{
    use GoogleCalendar;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:calendar {--tomorrow}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Google Calender Notifications';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Exception
     */
    public function handle(): int
    {
        $tomorrow = $this->option('tomorrow');
        $addDays = $tomorrow ? 1 : 0;

        $min = Carbon::now()->addDays($addDays)->startOfDay()->setTimezone('UTC')->toIso8601String();
        $max = Carbon::now()->addDays($addDays)->endOfDay()->setTimezone('UTC')->toIso8601String();

        $calUser = User::find(1);
        $token = $calUser->google_token;

        $this->googleCalendarInit();
        $this->googleClient->setAccessToken($token);

        if ($this->googleClient->isAccessTokenExpired()) {
            $this->googleClient->getRefreshToken();
            $token = $this->googleClient->fetchAccessTokenWithRefreshToken($this->googleClient->getRefreshToken());
            $calUser->update([
                'google_token' => $token['access_token'],
            ]);
        }

        $service = new \Google\Service\Calendar($this->googleClient);

        $calendarId = config('services.google.calendar-id');
        $optParams = [
            'maxResults'   => 10,
            'orderBy'      => 'startTime',
            'singleEvents' => true,
            'timeMin'      => $min,
            'timeMax'      => $max,
        ];

        $results = $service->events->listEvents($calendarId, $optParams);
        $events = $results->getItems();

        $items = [];

        foreach ($events as $event) {
            $startTime = $event->getStart()->getDateTime();
            $endTime = $event->getEnd()->getDateTime();
            if ($startTime && $endTime) {
                $from = UtcToLocal(Carbon::parse($startTime))->format('H:i');
                $to = UtcToLocal(Carbon::parse($endTime))->format('H:i');

                $items[] = $event->summary.' ('.$from.'-'.$to.')';

                continue;
            }
            $items[] = $event->summary;
        }

        $count = count($items);
        if ($count) {
            $content = $tomorrow ? trans_choice('Termin Morgen|Termine Morgen', $count) :
                trans_choice('Termin Heute|Termine Heute', $count);
            $content = '<strong>'.$content.'</strong>';

            foreach ($items as $item) {
                $content.= "\n".$item;
            }

            Notification::send(config('services.telegram-bot-api.home-group'), new HtmlText($content));
        }

        return 0;
    }
}
