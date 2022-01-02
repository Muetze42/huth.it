<?php


namespace App\Services\Paginator;

use Illuminate\Pagination\LengthAwarePaginator as BaseLengthAwarePaginator;

class LengthAwarePaginator extends BaseLengthAwarePaginator
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'current_site'   => $this->currentPage(),
            'data'           => $this->items->toArray(),
            'first_page_url' => $this->url(1),
            'from'           => $this->firstItem(),
            'last_site'      => $this->lastPage(),
            'last_page_url'  => $this->url($this->lastPage()),
//            'links'          => $this->linkCollection(),
//            'links'          => $this->linkCollection()->toArray(),
            'next_page_url'  => $this->nextPageUrl(),
//            'path'           => $this->path(),
            'limit'          => $this->perPage(),
            'prev_page_url'  => $this->previousPageUrl(),
            'to'             => $this->lastItem(),
            'total'          => $this->total(),
        ];
    }
}
