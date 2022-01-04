<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepositoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'repo'        => $this->repo,
            'branch'      => $this->branch,
            'description' => $this->description,
            'download'    => route('api.consumer.repositories.download', $this),
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'timestamp'   => $this->updated_at->timestamp,
        ];
    }
}
