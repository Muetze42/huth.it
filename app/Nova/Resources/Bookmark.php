<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\TagsField\Tags;
use Titasgailius\SearchRelations\SearchesRelations;

class Bookmark extends Resource
{
    use SearchesRelations;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Bookmark::class;

    /**
     * Get the logical group associated with the resource.
     *
     * @return string
     */
    public static function group(): string
    {
        return novaCat('Bookmarks');
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
        'url',
        'description',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static array $searchRelations = [
        'tags' => ['name'],
        'category' => ['name'],
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
            Text::make(__('Link'), 'title', function () {
                return '<a href="'.e($this->url).'" target="_blank" rel="noreferrer" class="'.config('site.nova.external_link_class').'">'.e($this->title).'</a><i class="'.config('site.nova.external_link_icon').'"></i>';
            })->sortable()->exceptOnForms()->asHtml(),

            Text::make(__('Title'), 'title')
                ->onlyOnForms()->required()->rules(['required']),
            Text::make(__('Url'), 'url')
                ->onlyOnForms()->required()->rules(['required']),

            Tags::make('Tags', 'tags')
                ->type(static::$model),

            Markdown::make(__('Description'), 'description'),

            BelongsTo::make(__('Category'), 'category', BookmarkCategory::class)
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
