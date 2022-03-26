<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * App\Models\GithubWebhook
 *
 * @property int $id
 * @property string $name
 * @property string $event
 * @property array|null $branches
 * @property array|null $actions
 * @property mixed|null $slug
 * @property mixed|null $secret
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TelegramReceiver[] $telegramReceivers
 * @property-read int|null $telegram_receivers_count
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook newQuery()
 * @method static \Illuminate\Database\Query\Builder|GithubWebhook onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook query()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook whereActions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook whereBranches($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubWebhook whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|GithubWebhook withTrashed()
 * @method static \Illuminate\Database\Query\Builder|GithubWebhook withoutTrashed()
 * @mixin \Eloquent
 */
class GithubWebhook extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'event',
        'branches',
        'actions',
        'slug',
        'secret',
        'message',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'slug'     => 'encrypted',
        'secret'   => 'encrypted',
        'branches' => 'array',
        'actions'  => 'array',
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted()
    {
        static::creating(function ($webhook) {
            $slugLength = config('webhook.slug-length', 8);
            $slugLength = $slugLength >= 4 ? $slugLength : 8;
            $webhook->slug = Str::random($slugLength);

            $secretLength = config('site.webhook.secret-length', 12);
            if ($secretLength) {
                $webhook->secret = Str::random($secretLength);
            }
        });
        static::saving(function ($webhook) {
            $webhook->branches = preg_replace('/\s+/', '', $webhook->branches);
        });
    }

    /**
     * The Telegram receivers that belong to the webhook.
     */
    public function telegramReceivers(): BelongsToMany
    {
        return $this->belongsToMany(TelegramReceiver::class);
    }
}
