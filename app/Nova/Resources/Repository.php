<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
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
        return novaCat('Consumer API');
    }

    /**
     * Custom priority level of the resource.
     *
     * @var int
     */
    public static int $priority = 20;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title(): string
    {
        return $this->repo.' ['.$this->branch.']';
    }

    /**
     * @return string|null
     */
    public function subtitle(): ?string
    {
        return $this->description;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'repo',
        'branch',
        'description',
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
            ID::make(__('ID'), 'id')
                ->sortable(),
            Text::make(__('Repo'), 'repo')
                ->rules('required', 'string')->sortable(),
            Text::make(__('Branch'), 'branch')
                ->rules('required', 'string')->sortable(),
            Text::make(__('Description'), 'description')
                ->sortable()->nullable(),

            DateTime::make(__('Updated at'), 'updated_at')
                ->sortable()->exceptOnForms(),

            BelongsToMany::make(__('Clients'), 'clients', Client::class),
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
