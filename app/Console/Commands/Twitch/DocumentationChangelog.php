<?php

namespace App\Console\Commands\Twitch;

use App\Notifications\Telegram\HtmlText;
use DOMDocument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use App\Models\TwitchDocumentationChangelog as Changelog;

class DocumentationChangelog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitch:changelog {--silent}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Documentation Changelog and notify';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $silent = $this->option('silent');

        $data  = file_get_contents('https://dev.twitch.tv/docs/change-log');

        $dom = new DOMDocument();
        $dom->loadHTML($data, LIBXML_NOERROR);
        $tables = $dom->getElementsByTagName('table');
        $table = $tables->item(0);
        $body = $table->getElementsByTagName('tbody');
        $rows = $body->item(0)->getElementsByTagName('tr');

        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td');

            $date = $cols[0]->nodeValue;
            $date = preg_replace('/\D/', ' ', $date);
            $date = preg_replace('/\s+/', '-', $date);

            $this->line($date);

            $changes = $cols[1]->nodeValue;

            $changelog = Changelog::where('date', $date)->first();
            if ($changelog) {
                return 0;
            }

            Changelog::create([
                'date' => $date,
                'changes' => $changes,
            ]);

            if (!$silent) {
                $content = "Twitch Documentation Changelog Update ".$date."\n<code>".Str::limit($changes, 1000)."</code>\nhttps://dev.twitch.tv/docs/change-log";
                Notification::send(config('services.telegram-bot-api.receiver'), new HtmlText($content));
            }
        }

        return 0;
    }
}
