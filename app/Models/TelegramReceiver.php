<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\TelegramReceiver
 *
 * @property int $id
 * @property int $telegram_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GithubWebhook[] $gitHubWebhooks
 * @property-read int|null $git_hub_webhooks_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramReceiver newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramReceiver newQuery()
 * @method static \Illuminate\Database\Query\Builder|TelegramReceiver onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramReceiver query()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramReceiver whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramReceiver whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramReceiver whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramReceiver whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramReceiver whereTelegramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramReceiver whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|TelegramReceiver withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TelegramReceiver withoutTrashed()
 * @mixin \Eloquent
 */
class TelegramReceiver extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'telegram_id',
        'name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'telegram_id' => 'integer',
    ];

    /**
     * The GitHub Webhooks that belong to the receiver.
     */
    public function gitHubWebhooks(): BelongsToMany
    {
        return $this->belongsToMany(GithubWebhook::class);
    }
}
