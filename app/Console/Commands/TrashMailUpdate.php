<?php

namespace App\Console\Commands;

use App\Models\TrashMail;
use Illuminate\Console\Command;

class TrashMailUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trash-mail:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Trash Mail';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $content = file_get_contents('https://cdn.jsdelivr.net/gh/andreis/disposable-email-domains@master/domains.json');

        $items = json_decode($content);

        foreach ($items as $item) {
            $data = $item[0] == '.' ? substr($item, 1) : $item;

            TrashMail::firstOrCreate(['provider' => $data]);
        }

        return 0;
    }
}
