<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Text;
use Titasgailius\SearchRelations\SearchesRelations;

class Activity extends Resource
{
    use SearchesRelations;

    /**
     * Custom priority level of the resource.
     *
     * @var int
     */
    public static int $priority = 100;

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Activity::class;

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return __('Activities');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel(): string
    {
        return __('Activity');
    }

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title(): string
    {
        return __('Activity').' '.$this->created_at->format('m.d.Y H:i:s');
    }

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string|null
     */
    public function subtitle(): ?string
    {
        if (!empty($this->subject) && !empty($this->causer)) {

            return __(class_basename($this->subject_type)).' „'.$this->subject->name.'“ '.__($this->description.' by :user', ['user' => $this->causer->name]);
        }

        if (!empty($this->subject)) {
            return __(class_basename($this->subject_type)).' „'.$this->subject->name.'“ '.__($this->description);
        }

        return null;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'properties',
    ];

    /**
     * The relationship columns that should be searched globally.
     *
     * @var array
     */
    public static array $globalSearchRelations = [
        'causer' => ['name', 'email'],
        'subject' => ['name', 'target'],
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static array $searchRelations = [
        'causer' => ['name', 'email'],
        'subject' => ['name', 'target'],
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
            Text::make(__('Event'), 'event')->sortable(),

            Text::make(__('Causer Type'), 'causer_type')
                ->sortable(),

            MorphTo::make(__('Causer'), 'causer'),

            Code::make(__('Old Properties'), 'properties->old')
                ->json(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                ->onlyOnDetail()->canSee(function () {
                    return $this->event != 'created';
                }),
            Code::make(__('New Properties'), 'properties->attributes')
                ->json(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                ->onlyOnDetail(),
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
