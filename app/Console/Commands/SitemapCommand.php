<?php

namespace App\Console\Commands;

use App\Helpers\Sitemap;
use Illuminate\Console\Command;

class SitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '(Re)generate sitemap';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        (new Sitemap)->create();

        return 0;
    }
}
