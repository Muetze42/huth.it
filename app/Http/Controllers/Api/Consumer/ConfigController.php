<?php

namespace App\Http\Controllers\Api\Consumer;

use App\Http\Controllers\Api\ApiController;
use App\Models\Config;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ConfigController extends ApiController
{
    protected array $array = [];

    /**
     * Show only
     *
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    protected function indexQuery(Builder $query, Request $request): Builder
    {
        return $query->where('client_id', auth()->user()->id);
    }

    /**
     * @return array
     */
    protected function indexAdditional(): array
    {
        return [
            'timestamps' => auth()->user()->configs->pluck('updated_at', 'name')->map(function ($value) {
                return $value->timestamp;
            })->toArray(),
        ];
    }

    /**
     * @param string $config
     * @return string|null
     */
    public function protectedShow(string $config): ?string
    {
        $config = Config::where('name', $config)->where('client_id', auth()->user()->id)->firstOrFail();

        $items = $this->items($config->items);

        return empty($items) ? null : opensslEncrypt(json_encode($items), $config->client->token);
    }

    /**
     * @param $items
     * @return array|null
     */
    protected function items($items): ?array
    {
        if (is_array($items) || is_object($items)) {
            $array = [];
            foreach ($items as $item) {
                if (!$item->type) {
                    $array[$item->key] = $this->items($item->items);
                    continue;
                }
                $array[$item->key] = $item->content_casted;
            }
            return $array;
        }
        return null;
    }
}