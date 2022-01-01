<?php

namespace App\Console\Commands\Development;

use Illuminate\Console\Command;

class IdeHelper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ide-helper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run `Laravel IDE Helper Generator` for `PHPDoc generation for Laravel Facades`, `PHPDocs for models` and `PhpStorm Meta file`';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        if (config('app.env') === 'local') {
            $this->call('ide-helper:models', ['--write' => true]);
            $this->call('ide-helper:generate');
            $this->call('ide-helper:meta');

            return 0;
        }

        $this->warn('The `ide-helper` is only for local development environment');

        return 0;
    }
}
