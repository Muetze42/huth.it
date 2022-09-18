<?php

namespace App\Console\Commands\Repositories;

use Illuminate\Console\Command;
use App\Models\Repository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repositories:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update GitHub repositories';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->handleRequest();

        return 0;
    }

    /**
     * @param int $page
     * @param int $perPage
     * @return void
     */
    protected function handleRequest(int $page = 1, int $perPage = 100): void
    {
        $url = sprintf('https://api.github.com/users/%s/repos?per_page=%d&page=%d&sort=pushed', config('services.github.user_name', 'Muetze42'), $perPage, $page);
        $response = Http::accept('application/json')
            ->get($url);
        $items = $response->json();

        foreach ($items as $item) {
            Repository::updateOrCreate(
                ['github_id' => data_get($item, 'id')],
                [
                    'name'              => data_get($item, 'name'),
                    'description'       => data_get($item, 'description'),
                    'homepage'          => data_get($item, 'homepage'),
                    'language'          => data_get($item, 'language'),
                    'stars'             => data_get($item, 'stargazers_count', 0),
                    'watchers_count'    => data_get($item, 'watchers_count', 0),
                    'forks'             => data_get($item, 'forks', 0),
                    'open_issues'       => data_get($item, 'open_issues', 0),
                    'watchers'          => data_get($item, 'watchers', 0),
                    'fork'              => data_get($item, 'fork', false),
                    'archived'          => data_get($item, 'archived', false),
                    'topics'            => data_get($item, 'topics', []),
                    'github_created_at' => Carbon::responseToDateTimeString(data_get($item, 'created_at')),
                    'github_updated_at' => Carbon::responseToDateTimeString(data_get($item, 'updated_at')),
                    'github_pushed_at'  => Carbon::responseToDateTimeString(data_get($item, 'pushed_at')),
                ]
            );
        }

        if (count($items) == $perPage) {
            $this->handleRequest($page + 1, $perPage);
        }
    }
}
