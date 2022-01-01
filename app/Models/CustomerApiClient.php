<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

/**
 * App\Models\CustomerApiClient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $description
 * @property string $client_id
 * @property mixed $token
 * @property mixed $refresh_token
 * @property \Illuminate\Support\Carbon|null $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient whereUpdatedAt($value)
 * @property int|null $token_lifetime
 * @property \Illuminate\Support\Carbon|null $used_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Repository[] $repositories
 * @property-read int|null $repositories_count
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient whereTokenLifetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient whereUserAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerApiClient whereUsedAt($value)
 */
class CustomerApiClient extends Authenticatable
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public function guardName(): string
    {
        return 'customer-api';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'description',
        'token',
        'refresh_token',
        'token_lifetime',
        'used_at',
        'expired_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'token',
        'refresh_token',
        'token_lifetime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'token'         => 'encrypted',
        'refresh_token' => 'encrypted',
        'used_at'       => 'datetime',
        'expired_at'    => 'datetime',
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted()
    {
        static::creating(function ($client) {
            $client->client_id = self::createId();
            $client->token = Str::random(32);
            $client->refresh_token = Str::random(32);
        });
    }

    protected static function createId(): string
    {
        $clientId = Str::random();
        $client = self::find($clientId);
        if ($client) {
            $clientId = self::createId();
        }

        return $clientId;
    }

    /**
     * The repositories that belong to the client.
     */
    public function repositories(): BelongsToMany
    {
        return $this->belongsToMany(Repository::class);
    }
}
