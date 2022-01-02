<?php

namespace App\Nova\Resources;

use App\Nova\Fields\SecretField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;

class Client extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Client::class;

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
    public static int $priority = 10;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'description';

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string
     */
    public function subtitle(): string
    {
        return $this->client_id;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'client_id',
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
            Text::make(__('Client ID'), 'client_id')
                ->sortable()->exceptOnForms(),
            SecretField::make(__('Token'), 'token')
                ->onlyOnDetail(),
            SecretField::make(__('Refresh Token'), 'refresh_token')
                ->onlyOnDetail(),

            Text::make(__('Description'), 'description')
                ->sortable()
                ->rules('required', 'string')
                ->creationRules('unique:clients,description')
                ->updateRules('unique:clients,description,{{resourceId}}'),

            DateTime::make(__('Used at'), 'used_at')
                ->sortable()->exceptOnForms(),

            DateTime::make(__('Expired at'), 'expired_at')
                ->sortable()->nullable(),

            BelongsToMany::make(__('Repositories'), 'repositories', Repository::class),
            HasMany::make(__('Configurations'), 'configs', Config::class),
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
