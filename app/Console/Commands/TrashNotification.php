<?php

namespace App\Console\Commands;

use App\Notifications\Telegram\HtmlText;
use Illuminate\Console\Command;
use App\Models\Date;
use App\Models\DateCategory;
use Illuminate\Support\Facades\Notification;

class TrashNotification extends Command
{
    protected string $tomorrow;
    protected string $dayAfterTomorrow;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trash:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trash notification';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->tomorrow = now()->addDay()->toDateString();
        $this->dayAfterTomorrow = now()->addDays(2)->toDateString();
        $content = null;

        $categories = DateCategory::whereHas('dates', function ($query) {
            $query->where('date', $this->tomorrow)
                ->where('notified', false);
        })->get()->pluck('name')->implode(', ');

        if ($categories) {
            $content = 'Morgen wird '.lastAnd($categories).' abgeholt.';
        }

        $categories = DateCategory::whereHas('dates', function ($query) {
            $query->where('date', $this->dayAfterTomorrow)
                ->where('notified2', false);
        })->get()->pluck('name')->implode(', ');

        if ($categories) {
            if ($content) {
                $content.="\n\n";
            }
            $content.= 'Übermorgen wird '.lastAnd($categories).' abgeholt.';
        }

        if ($content) {
            Notification::send(-1001544317562, new HtmlText($content));
        }

        Date::where('date', $this->tomorrow)->update(['notified' => true]);
        Date::where('date', $this->dayAfterTomorrow)->update(['notified2' => true]);

        return 0;
    }
}
