<?php

namespace App\Nova\Resources;

use App\Nova\Fields\SecretField;
use App\Nova\Filters\GithubWebhook\EventFilter;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Fields\ConditionalContainer;
use DigitalCreative\ConditionalContainer\HasConditionalContainer;
use NovaItemsField\Items;

class GithubWebhook extends Resource
{
    use HasConditionalContainer;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\GithubWebhook::class;

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
        'name',
        'event',
        'branches',
        'actions',
        'slug',
        'message',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request): array
    {
        $github = config('webhook.github');
        $options = array_keys($github);

        $fields = [
            Text::make(__('name'), 'name')
                ->sortable()
                ->rules('required', 'max:254')
                ->creationRules('unique:github_webhooks,name')
                ->updateRules('unique:github_webhooks,name,{{resourceId}}'),
            Select::make(__('Event'), 'event')
                ->options(array_combine($options, $options))
                ->sortable()->rules('required'),

            Text::make(__('Message'), 'message', function () {
                return e($this->message);
            })->sortable()->asHtml(),
            Textarea::make(__('Message'), 'message')
                ->alwaysShow()->rules('required')->onlyOnForms()
                ->help(__('Variables: {repoName}, {repoUrl}, {repoVendor}, {branch}, {causerName}, {causerId}. Use <strong class="text-danger bg-60 px-1 rounded font-bold">`</strong> for Telegram code style.')),

            Items::make(__('Branches'), 'branches')
                ->help(__('Keep empty for every branch')),
            Text::make(__('Webhook'), function () {
                return route('api.webhooks.github', ['webhook' => $this->id, 'slug' => $this->slug]);
            })->onlyOnDetail(),
            SecretField::make(__('Secret'), 'secret')
                ->nullable()->hideFromIndex()->hideWhenCreating(),
        ];

        foreach ($github as $event => $actions) {
            if (!empty($actions)) {
                $fields = array_merge($fields, [
                    ConditionalContainer::make([
                        BooleanGroup::make(__('Actions'), 'actions')
                            ->options(array_combine($actions, $actions)),
                    ])->if('event = '.$event),
                ]);
            } else {
                $fields = array_merge($fields, [
                    ConditionalContainer::make([
                        Hidden::make('actions')->default([]),
                    ])->if('event = '.$event),
                ]);
            }
        }

        return array_merge($fields, [
            BelongsToMany::make(__('Telegram Receivers'), 'telegramReceivers', TelegramReceiver::class),
        ]);
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
        return [
            (new EventFilter)->canSee(function () {
                return static::$model::count();
            }),
        ];
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
