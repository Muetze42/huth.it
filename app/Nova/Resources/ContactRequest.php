<?php

namespace App\Nova\Resources;

use App\Nova\Actions\ContactRequest\ChangeStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class ContactRequest extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\ContactRequest::class;

    /**
     * Custom priority level of the resource.
     *
     * @var int
     */
    public static int $priority = 20;

    /**
     * Get the logical group associated with the resource.
     *
     * @return string
     */
    public static function group(): string
    {
        return novaCat('System');
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return __('Contact requests');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel(): string
    {
        return __('Contact request');
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'subject';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'subject',
        'message',
        'email',
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
            Text::make(__('Subject'), 'subject')
                ->sortable(),
            Textarea::make(__('Message'), 'message')
                ->alwaysShow()->onlyOnDetail(),
            Text::make(__('Email'), 'email')
                ->sortable(),
            Text::make(__('Name'), 'name')
                ->sortable(),
            Text::make(__('Status'), 'status', function () {
                return '<i class="'.static::$model::STATUS_COLORS[$this->status].' fas '.static::$model::STATUS_ICONS[$this->status].' fa-lg"></i>';
            })->sortable()->asHtml(),
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
        return [
            new ChangeStatus,
        ];
    }

    /**
     * Determine if the current user can update the given resource.
     *
     * @param Request $request
     * @return bool
     */
    public function authorizedToUpdate(Request $request): bool
    {
        if ($request->action) {
            return parent::authorizedTo($request, 'view');
        }

        return parent::authorizedTo($request, 'update');
    }
}
