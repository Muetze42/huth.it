<?php

namespace App\Console\Commands\Development;

class HelperCommand extends IdeHelperCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'helper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alias for `ide-helper` command';
}
