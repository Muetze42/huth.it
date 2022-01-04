<?php

namespace App\Nova\Resources;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Http\Controllers\AttachableController;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;
//use Laravel\Scout\Builder as ScoutBuilder;

abstract class Resource extends NovaResource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = '<span class="hidden">0</span>';

    /**
     * The column by which to sort as default
     *
     * @var string
     */
    public static string $defaultSort = '';

    /**
     * Sort ascending or descending as default
     *
     * @var string
     */
    public static string $defaultOrder = 'asc';

    /**
     * Build an "index" query for the given resource.
     *
     * @param NovaRequest $request
     * @param  Builder  $query
     * @return Builder
     */
    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        if (static::$defaultSort && empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            return $query->orderBy(static::$defaultSort, static::$defaultOrder);
        }
        return $query;
    }

    /**
     * Build a Scout search query for the given resource.
     *
     * @param NovaRequest $request
     * @param  ScoutBuilder  $query
     * @return ScoutBuilder
     */
    public static function scoutQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a "detail" query for the given resource.
     *
     * @param NovaRequest $request
     * @param  Builder  $query
     * @return Builder
     */
    public static function detailQuery(NovaRequest $request, $query): Builder
    {
        return parent::detailQuery($request, $query);
    }

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param NovaRequest $request
     * @param  Builder  $query
     * @return Builder
     */
//    public static function relatableQuery(NovaRequest $request, $query): Builder
//    {
//        return parent::relatableQuery($request, $query);
//    }
    public static function relatableQuery(NovaRequest $request, $query): Builder
    {
        if ($request->route()->getController() instanceof AttachableController) {
            $key = $query->getModel()->getQualifiedKeyName();

            return $query->where(function (Builder $builder) use ($key, $query, $request) {
                $builder->whereNotIn($key, function ($subQuery) use ($key, $query, $request) {
                    $subQuery->fromSub(
                        $request->findModelOrFail()->{$request->field}()->select($key)->getQuery(), 'tmp'
                    );
                })->when($request->get('current'), function (Builder $builder, $current) use ($key) {
                    $builder->orWhere($key, $current);
                });
            });
        }

        return parent::relatableQuery($request, $query);
    }
}
