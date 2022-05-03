<?php

namespace App\Nova\Resources;

use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use NormanHuth\Values\Values;
use NormanHuth\SecretField\SecretField;
use Laravel\Nova\Fields\FormData;

class GithubWebhook extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\GithubWebhook::class;

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return __('Github Webhooks');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel(): string
    {
        return __('Github Webhook');
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
     * @param  NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request): array
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

            Values::make(__('Branches'), 'branches')
                ->help(__('Keep empty for every branch')),
            Text::make(__('Webhook'), function () {
                return route('api.webhooks.github', ['webhook' => $this->id, 'slug' => $this->slug]);
            })->onlyOnDetail(),
            SecretField::make(__('Secret'), 'secret')
                ->nullable()->hideFromIndex()->hideWhenCreating(),
        ];

//        foreach ($github as $event => $actions) {
//            if (!empty($actions)) {
//                $fields = array_merge($fields, [
//                    BooleanGroup::make(__('Actions'), 'actions')
//                        ->options(array_combine($actions, $actions))->dependsOn(
//                            ['event'],
//                            function (BooleanGroup $field, NovaRequest $request, FormData $formData) use ($event) {
//                                if ($formData->event === $event) {
//                                    $field->show();
//                                } else {
//                                    $field->hide();
//                                }
//                            }
//                        ),
//                ]);
//            } else {
//                $fields = array_merge($fields, [
//                    Hidden::make('actions')->default([]),
//                ]);
//            }
//        }

        return array_merge($fields, [
            BelongsToMany::make(__('Telegram Receivers'), 'telegramReceivers', TelegramReceiver::class),
        ]);
    }

    /**
     * Get the cards available for the request.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
