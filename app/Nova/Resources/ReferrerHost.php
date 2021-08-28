<?php

namespace App\Nova\Resources;

use App\Nova\Metrics\Referrer\ReferrerDomain;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Titasgailius\SearchRelations\SearchesRelations;

class ReferrerHost extends Resource
{
    use SearchesRelations;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\ReferrerHost::class;

    /**
     * Get the logical group associated with the resource.
     *
     * @return string
     */
    public static function group(): string
    {
        return novaCat('Referrers');
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
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static array $searchRelations = [
        'referrers' => ['url', 'ip'],
    ];

    /**
     * The relationship columns that should be searched globally.
     *
     * @var array
     */
    public static array $globalSearchRelations = [
        'referrers' => ['url', 'ip'],
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
            Text::make(__('Name'), 'name', function () {
                return '<a href="https://'.e($this->name).'" class="'.config('muetze-site.nova.external_link_class').'" rel="noopener noreferrer" target="_blank">'.e($this->name).'</a><i class="'.config('muetze-site.nova.external_link_icon').'"></i>';
            })->sortable()->asHtml(),

            Text::make(__('Referrers'), 'referrer_count', function () {
                return '<a href="'.config('nova.path').'/resources/referrer-hosts/'.$this->id.'" class="'.config('muetze-site.nova.external_link_class').' font-bold">'.$this->referrer_count.'</a>';
            })->sortable()->asHtml()->onlyOnIndex(),

            HasMany::make(__('Referrers'), 'referrers', Referrer::class),
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
            new ReferrerDomain,
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
