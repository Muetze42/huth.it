<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Repository;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Exception;

class RepositoryController extends Controller
{
    protected ?Repository $repo;

    /**
     * @param string $package
     * @return Model|Builder|Repository
     */
    public function info(string $package): Model|Builder|Repository
    {
        $this->repoAccess($package);

        return $this->repo;
    }

    /**
     * @throws GuzzleException
     * @return void|string
     */
    public function download(string $package)
    {
        $this->repoAccess($package);

        try {
            $client = new Client;

            $url = sprintf(
                'https://api.github.com/repos/%s/%s/zipball/%s',
                config('services.github.owner'),
                $this->repo->package,
                $this->repo->branch,
            );

            $response = $client->request('GET', $url, [
                'stream' => true,
                'headers' => [
                    'Authorization' => 'token '.config('services.github.access_token'),
                ]
            ]);

            header('Content-Type: application/zip');
            header('Content-Transfer-Encoding: Binary');
            header('Expires: 0');
            header('Content-Disposition: attachment; filename=hallo-alexa-ui.zip');

            return $response->getBody()->getContents();
        } catch (Exception $exception) {
            abort(jsonResponse($exception, 500));
        }
    }

    protected function repoAccess(string $package)
    {
        $this->repo = Repository::where('package', $package)->firstOrFail();

        if (!$this->repo->customerApiClients()->wherePivot('id', auth()->id())->exists()) {
            abort(jsonResponse('This client does not have permission for this repository', 401));
        }
    }
}
