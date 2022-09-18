<?php

namespace App\Console\Commands\Repositories;

use App\Models\Repository;
use DOMDocument;
use DOMXPath;
use Illuminate\Console\Command;

class PackagistUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repositories:packagist:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update repositories from packagist';

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
     * @return void
     */
    protected function handleRequest(int $page = 1): void
    {
        $user = config('services.packagist.user', 'Muetze');
        $url = sprintf('https://packagist.org/users/%s/packages/?page=%d', $user, $page);
        $html = file_get_contents($url);

        $doc = new DOMDocument();
        $doc->loadHTML($html, LIBXML_NOERROR);
        $finder = new DomXPath($doc);
        $classname = 'packages';
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

        foreach ($nodes as $node) {
            $packages = $node->getElementsByTagName('li');
            foreach ($packages as $package) {
                $name = basename($package->getElementsByTagName('a')[0]->nodeValue);
                $downloads = preg_replace('/\D/', '', $package->getElementsByTagName('span')[0]->nodeValue);

                Repository::where('name', basename($name))
                    ->first()
                    ?->update([
                        'packagist_downloads' => $downloads,
                    ]);
            }
        }

        $classname = 'pagination';
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            $links = $node->getElementsByTagName('a');
            foreach ($links as $link) {
                if ($link->getAttribute('rel') && $link->getAttribute('rel') == 'next') {
                    $parts = explode('=', $link->getAttribute('href'));
                    if (isset($parts[1]) && $parts[1] > $page) {
                        $this->handleRequest($parts[1]);
                    }
                }
            }
        }
    }
}
