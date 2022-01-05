<?php

namespace App\Nova\Resources;

use Bernhardh\NovaIconSelect\IconProviders\FontAwesomeIconProvider;
use Bernhardh\NovaIconSelect\NovaIconSelect;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Text;
use App\Traits\HasSortableRows;
use Timothyasp\Color\Color;
use App\Nova\Metrics\Link\LinkCountTrend;
use App\Nova\Metrics\Link\LinkRealCountTrend;
use App\Nova\Metrics\Link\LinkCounts;
use App\Nova\Metrics\Link\LinkRealCounts;

class Link extends Resource
{
    use HasSortableRows;

    /**
     * Custom priority level of the resource.
     *
     * @var int
     */
    public static int $priority = 10;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Link::class;

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return __('Links');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel(): string
    {
        return __('Link');
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string
     */
    public function subtitle(): string
    {
        return $this->target;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'target',
        'icon',
        'color',
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
            Boolean::make(__('Active'), 'active'),

            NovaIconSelect::make('Icon')
                ->setIconProvider(new FontAwesomeIconProvider(['solid', 'regular', 'brands']))->nullable(),

            Text::make(__('Name'), 'name')
                ->required()->rules('required', 'max:50'),

            Text::make(__('Link'), 'target')
                ->required()->rules('required', 'url'),

            Color::make('Button Color', 'color')
                ->required()->rules('required'),

            Text::make(__('Count'), 'count', function () {
                return number_format($this->count, 0, ',', '.');
            })
                ->exceptOnForms(),

            Text::make(__('Real Count'), 'real_count', function () {
                return number_format($this->real_count, 0, ',', '.');
            })->exceptOnForms(),

            MorphMany::make(__('Activities'), 'activities', Activity::class),
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
        return [
            (new LinkCountTrend)->onlyOnDetail(),
            (new LinkRealCountTrend)->onlyOnDetail(),
            new LinkCounts,
            new LinkRealCounts,
        ];
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
