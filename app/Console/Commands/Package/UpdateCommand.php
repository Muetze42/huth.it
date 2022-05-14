<?php

namespace App\Console\Commands\Package;

use App\Models\Package;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update composer packages';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $vendors = explode(',', config('services.composer.vendors'));

        foreach ($vendors as $vendor) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL            => 'https://packagist.org/packages/list.json?vendor='.$vendor,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'GET',
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response, true);
            foreach ($data['packageNames'] as $package) {
                $this->updatePackage($package);
            }
        }

        return 0;
    }

    protected function updatePackage(string $package)
    {
        $data = null;
        $data['packagist'] = $package;
        /*
         * Getting package data
         */
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL            => 'https://repo.packagist.org/p2/'.$package.'.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'User-Agent: huth.it Request',
                'Content-Type: application/json',
            ],
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $array = json_decode($response, true);

        foreach ($array['packages'] as $composerPackage) {
            if (!empty($composerPackage[0])) {;
                $data['github'] = str_replace(['https://github.com/', '.git'], '', $composerPackage[0]['source']['url']);
                $data['version'] = $composerPackage[0]['version'];

                /*
                 * Getting repository data
                 */
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL            => 'https://api.github.com/repos/'.$data['github'],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING       => '',
                    CURLOPT_MAXREDIRS      => 10,
                    CURLOPT_TIMEOUT        => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST  => 'GET',
                    CURLOPT_HTTPHEADER     => [
                        'User-Agent: huth.it Request',
                        'Authorization: Bearer '.config('services.github.access_token'),
                        'Content-Type: application/json',
                    ],
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $array = json_decode($response, true);
                $data['stars'] = $array['stargazers_count'];
                $data['description'] = $array['description'];
                $name = $array['name'];
                $data['forks'] = $array['forks_count'];
                $data['watchers'] = $array['watchers'];
                $data['pushed_at'] = $array['pushed_at'] ?? Carbon::fromApiToDateTimeString($array['pushed_at']);
                $topics = $array['topics'];
                $data['homepage'] = empty($array['homepage']) ? null : $array['homepage'];
                Log::debug($data['homepage']);
                $data['parent'] = $array['fork'] ? $array['parent']['html_url'] : null;

                /*
                 * Getting packagist data
                 */
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL            => 'https://packagist.org/packages/'.$package.'.json',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING       => '',
                    CURLOPT_MAXREDIRS      => 10,
                    CURLOPT_TIMEOUT        => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST  => 'GET',
                    CURLOPT_HTTPHEADER     => [
                        'User-Agent: huth.it Request',
                        'Content-Type: application/json',
                    ],
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $array = json_decode($response, true);
                $data['downloads'] = $array['package']['downloads']['total'];

                /*
                 * Get the latest release
                 */
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL            => 'https://api.github.com/repos/'.$data['github'].'/releases/latest',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING       => '',
                    CURLOPT_MAXREDIRS      => 10,
                    CURLOPT_TIMEOUT        => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST  => 'GET',
                    CURLOPT_HTTPHEADER     => [
                        'User-Agent: huth.it Request',
                        'Authorization: Bearer '.config('services.github.access_token'),
                        'Content-Type: application/json',
                    ],
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $array = json_decode($response, true);

                $data['released_at'] = !empty($array['published_at']) ? Carbon::fromApiToDateTimeString($array['published_at']) : null;

                Package::updateOrCreate(
                    ['name' => $name],
                    $data
                )->syncTags($topics);
            }
        }
    }
}
