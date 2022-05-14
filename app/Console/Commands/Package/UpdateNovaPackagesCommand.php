<?php

namespace App\Console\Commands\Package;

use Illuminate\Console\Command;
use App\Models\Package;

class UpdateNovaPackagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:update:novapackages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update novapackages.com data for composer packages';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $packages = Package::where('homepage', 'LIKE', 'https://novapackages.com%')->get();

        foreach ($packages as $package) {
            $data = $this->getNovaPackagesData($package->homepage);
            $package->update([
                'np_rates' => $data['rating_count'],
                'np_rating' => $data['average_rating'],
            ]);
        }

        return 0;
    }

    protected function getNovaPackagesData(string $url): array
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        preg_match('/:package="(.*?)"/s', $response, $match);
        return json_decode(htmlspecialchars_decode($match[1]), true);
    }
}
