<?php

namespace App\Nova\Resources;

use App\Nova\Fields\SecretField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Text;

class CustomerApiClient extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\CustomerApiClient::class;

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
    public static $title = 'client_id';

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
                ->exceptOnForms()->sortable(),
            Text::make(__('Client ID'), 'client_id')
                ->sortable()
                ->rules('required', 'string', 'max:254')
                ->creationRules('unique:customer_api_clients,description')
                ->updateRules('unique:customer_api_clients,description,{{resourceId}}'),
            SecretField::make(__('Token'), 'token')
                ->onlyOnDetail(),
            SecretField::make(__('Refresh Token'), 'refresh_token')
                ->onlyOnDetail(),
            DateTime::make(__('expired_at'), 'expired_at')
                ->nullable()
                ->sortable(),
            DateTime::make(__('Updated at'), 'updated_at')
                ->exceptOnForms()
                ->sortable(),
            DateTime::make(__('Created at'), 'created_at')
                ->exceptOnForms()
                ->sortable(),

            BelongsToMany::make(__('Repositories'), 'repositories', Repository::class),
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
