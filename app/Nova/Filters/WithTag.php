<?php

namespace App\Nova\Filters;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Filters\Filter;

class WithTag extends Filter
{
    protected string $type;

    public function __construct($type)
    {
       $this->type = $type;
    }

    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Tag');
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param Builder  $query
     * @param mixed  $value
     * @return Builder
     */
    public function apply(Request $request, $query, $value): Builder
    {
        return $query->whereHas('tags', function ($query) use ($value) {
            $query->where('id', $value);
        });
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        return Tag::where('type', $this->type)->orderBy('name->en')->get()->pluck('id', 'name')->toArray();
    }
}
