<?php

namespace App\Console\Commands\Development;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Routes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:save {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save the `route:list` output to `/storage/data/routes.txt` or `/storage/data/{name}.txt`';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        if (!is_dir(storage_path('data'))) {
            mkdir(storage_path('data'));
        }

        $name = $this->option('name');
        $name = $name ?: 'routes';

        $file = storage_path('data/'.$name.'.txt');
        Artisan::call('route:list');
        file_put_contents($file, Artisan::output());

        $this->info(__('The `route::name` were saved in the file `:file`', ['name' => $name, 'file' => $file]));

        return 0;
    }
}
