<?php

namespace App\Nova\Actions\ContactRequest;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use App\Models\ContactRequest;

class ChangeStatus extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name(): string
    {
        return __('Send/Change status');
    }

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return void
     */
    public function handle(ActionFields $fields, Collection $models): void
    {
        $status = $fields['status'];
        foreach ($models as $model) {
            if ($model->status == ContactRequest::STATUS_SENT) {
                continue;
            }
            $model->update(['status' => $status]);
            if ($status == ContactRequest::STATUS_SENT) {
                Mail::raw($model->message, function ($message) use ($model) {
                    $message->subject($model->subject)->from(config('mail.from.address'), $model->name)->to('norman@huth.it', 'Norman')->replyTo($model->email, $model->name);
                });
            }
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Select::make(__('Status'), 'status')->options([
                ContactRequest::STATUS_SENT => __('E-Mail versenden'),
                ContactRequest::STATUS_REJECTED => __('Nachricht abweisen'),
            ])->displayUsingLabels()->required()->rules('required')
        ];
    }
}
