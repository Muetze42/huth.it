<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Text;

class Repository extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Repository::class;

    /**
     * Get the logical group associated with the resource.
     *
     * @return string
     */
    public static function group(): string
    {
        return novaCat('Customer API');
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'package';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'package',
        'description',
        'reference',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            Text::make(__('Package'), 'package')
                ->sortable()
                ->rules('required', 'string', 'max:254')
                ->creationRules('unique:repositories,package')
                ->updateRules('unique:repositories,package,{{resourceId}}'),
            Text::make(__('Branch'), 'branch')
                ->rules('required', 'string', 'max:254')->default('main'),
            Text::make(__('Description'), 'description')
                ->rules('required', 'string', 'max:254'),
            Text::make('Reference', 'reference')
                ->hideFromIndex()
                ->hideWhenCreating()
                ->rules('required', 'string', 'max:254'),

            BelongsToMany::make(__('Customer API Clients'), 'customerApiClients', CustomerApiClient::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param Request $request
     * @return array
     */
    public function cards(Request $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function filters(Request $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function actions(Request $request): array
    {
        return [];
    }
}
