<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Tightenco\Ziggy\Ziggy;

class ZiggyProduction extends Command
{
    public static $generated;
//    public static ?Ziggy $payload;
    public static $payload;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ziggy:production';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a JavaScript file containing Ziggy’s routes.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $payload = new Ziggy();
        $ziggy = $payload->toJson();
        $function = file_get_contents(base_path('vendor/tightenco/ziggy/dist/index.js'));

        file_put_contents(public_path('js/ziggy.js'), 'const Ziggy = '.$ziggy.';'.$function);

        return 0;
    }
}
