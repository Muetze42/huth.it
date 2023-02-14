<?php

namespace App\Console\Commands;

use App\Models\Package;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class NovaPackagesUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'novapackages:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update repositories from novapackages.com';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->handleRequest();
    }

    /**
     * @param int $page
     * @param int $perPage
     * @return void
     */
    protected function handleRequest(int $page = 1, int $perPage = 100): void
    {
        $author = config('services.novapackages.author', 'Norman Huth');
        $token = config('services.novapackages.token');
        $url = sprintf('https://novapackages.com/api/packages?author_name=%s&page=%d', $author, $page);
        $response = Http::withToken($token)
            ->accept('application/json')
            ->get($url);
        $items = $response->json('data');
        $meta = $response->json('meta');

        foreach ($items as $item) {
            Package::where('name', basename($item['url']))
                ->first()
                ?->update([
                    'rating'           => $item['rating'],
                    'rating_count'     => $item['rating_count'],
                    'novapackages_url' => $item['novapackages_url'],
                ]);
        }

        if ($meta['to'] < $meta['total']) {
            $this->handleRequest($page + 1);
        }
    }
}
