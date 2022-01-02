<?php

namespace App\Http\Controllers\Api\Consumer;

use App\Http\Controllers\Api\ApiController;
use App\Models\Repository;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RepositoryController extends ApiController
{
    protected array $repositoriesIds;
    protected array $indexLikeFilter = [
        'repo',
        'description',
    ];

    protected function getRepositoriesIds(): array
    {
        if (empty($this->repositoriesIds)) {
            $this->repositoriesIds = auth()->user()->repositories->pluck('id')->toArray();
        }

        return $this->repositoriesIds;
    }

    /**
     * Show only
     *
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    protected function indexQuery(Builder $query, Request $request): Builder
    {
        return $query->whereIn('id', $this->getRepositoriesIds());
    }

    protected function showDeny($resource): bool
    {
        return !in_array($resource->id, $this->getRepositoriesIds());
    }

    /**
     * @throws GuzzleException
     */
    public function download(Repository $repository): JsonResponse|string
    {
        if (!$repository->clients()->wherePivot('client_id', auth()->user()->id)->exists()) {
            return jsonResponse('Access denied', 401);
        }

        $url = sprintf(
            'https://api.github.com/repos/%s/%s/zipball/%s',
            config('services.github.owner'),
            $repository->repo,
            $repository->branch,
        );

        $client = new Client;

        $response = $client->request('GET', $url, [
            'stream' => true,
            'headers' => [
                'Authorization' => 'token '.config('services.github.access_token'),
            ]
        ]);

        header('Content-Type: application/zip');
        header('Content-Transfer-Encoding: Binary');
        header('Expires: 0');
        header('Content-Disposition: attachment; filename='.$repository->repo.'.zip');

        return $response->getBody()->getContents();
    }
}
