<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Http\Controllers\AttachableController;

class TelegramReceiver extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\TelegramReceiver::class;

    /**
     * Get the logical group associated with the resource.
     *
     * @return string
     */
    public static function group(): string
    {
        return novaCat('Webhooks');
    }

    /**
     * @param NovaRequest $request
     * @param Builder $query
     * @return Builder
     */
    public static function relatableQuery(NovaRequest $request, $query): Builder
    {
        if ($request->route()->getController() instanceof AttachableController) {
            $webhook = \App\Models\GithubWebhook::find($request->resourceId);
            $receiverIds = $webhook->telegramReceivers->pluck('id');

            return $query->whereNotIn('id', $receiverIds);
        }

        return parent::relatableQuery($request, $query);
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'telegram_id',
        'name',
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
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255')->creationRules('unique:telegram_receivers,name')
                ->updateRules('unique:telegram_receivers,name,{{resourceId}}'),
            Number::make(__('Telegram ID'), 'telegram_id')
                ->step(1)->sortable()
                ->rules('required')
                ->creationRules('unique:telegram_receivers,telegram_id')
                ->updateRules('unique:telegram_receivers,telegram_id,{{resourceId}}'),
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
