<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Browser;
use App\Models\LinkCount;
use App\Models\Referrer;

class IpClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ip:clear';

    /**
     * The console command description.#
     *
     * @var string
     */
    protected $description = 'Set not longer needed IPs to null of the `link_counts` table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $delay = config('muetze-site.count_delay', 240);
        LinkCount::where('created_at', '<', now()->subMinutes($delay))->update(['ip' => null]);

        Referrer::where('created_at', '<', now()->subHour())->update(['ip' => null]);

        Browser::where('created_at', '<', now()->subDay())->update(['ip' => null]);

        return 0;
    }
}
