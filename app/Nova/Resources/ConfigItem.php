<?php

namespace App\Nova\Resources;

use App\Traits\Nova\RedirectToParent;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use DigitalCreative\ConditionalContainer\ConditionalContainer;
use DigitalCreative\ConditionalContainer\HasConditionalContainer;

class ConfigItem extends Resource
{
    use HasConditionalContainer, RedirectToParent;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\ConfigItem::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'key';

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string
     */
    public function subtitle(): string
    {
        return match ($this->type) {
            static::$model::TYPE_KEY => 'KEY',
            static::$model::TYPE_BOOL => 'BOOL',
            static::$model::TYPE_INT => 'INT',
            static::$model::TYPE_NULL => 'NULL',
            static::$model::TYPE_FLOAT => 'FLOAT',
            default => 'STRING',
        };
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'key',
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
            Text::make(__('Key'), 'key')
                ->sortable()
                ->rules('required', 'string', 'max:100'), # Todo: Unique Relation Rule

            Text::make(__('Content'), 'content', function () {
                return $this->content_casted;
            })->onlyOnIndex(),

            Select::make(__('Type'), 'type')
                ->displayUsingLabels()
                ->options([
                    static::$model::TYPE_KEY    => 'KEY',
                    static::$model::TYPE_STRING => 'STRING',
                    static::$model::TYPE_BOOL   => 'BOOL',
                    static::$model::TYPE_INT    => 'INT',
                    static::$model::TYPE_NULL   => 'NULL',
                    //static::$model::TYPE_FLOAT  => 'FLOAT',
                ])->rules('required')->onlyOnForms(),
            Text::make(__('Type'), 'type', function () {
                return match ($this->type) {
                    static::$model::TYPE_KEY => '<span class="font-weight">KEY</span>',
                    static::$model::TYPE_BOOL => 'BOOL',
                    static::$model::TYPE_INT => 'INT',
                    static::$model::TYPE_NULL => 'NULL',
                    static::$model::TYPE_FLOAT => 'FLOAT',
                    default => 'STRING',
                };
            })->sortable()->exceptOnForms()->asHtml(),

            ConditionalContainer::make([
                Text::make(__('Content'), 'content')
                    ->rules('required', 'string'),
            ])->if('type = '.static::$model::TYPE_STRING),
            ConditionalContainer::make([
                Boolean::make(__('Content'), 'content'),
            ])->if('type = '.static::$model::TYPE_BOOL),
            ConditionalContainer::make([
                Number::make(__('Content'), 'content')
                    ->nullable()->step(1),
            ])->if('type = '.static::$model::TYPE_INT),
//            ConditionalContainer::make([
//                Number::make(__('Content'), 'content')
//                    ->nullable()->step('any'),
//            ])->if('type = '.static::$model::TYPE_FLOAT),

            BelongsTo::make(__('Parent'), 'parent', self::class)
                ->canSee(function () {
                    return isset($this->parent_id) && $this->parent_id;
                })->exceptOnForms(),

            BelongsTo::make(__('Config'), 'config', Config::class)
                ->canSee(function () {
                    return isset($this->config_id) && $this->config_id;
                })->exceptOnForms(),

            HasMany::make(__('Items'), 'items', ConfigItem::class)
                ->canSee(function () {
                    return isset($this->type) && $this->type == static::$model::TYPE_KEY;
                }),
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
