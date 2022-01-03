<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Client
 *
 * @method static Builder|Client newModelQuery()
 * @method static Builder|Client newQuery()
 * @method static Builder|Client query()
 * @mixin Eloquent
 * @property int $id
 * @property string $client_id
 * @property mixed $token
 * @property mixed $refresh_token
 * @property Carbon|null $expired_at
 * @property Carbon|null $used_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Client[] $repositories
 * @property-read int|null $repositories_count
 * @method static Builder|Client whereClientId($value)
 * @method static Builder|Client whereCreatedAt($value)
 * @method static Builder|Client whereExpiredAt($value)
 * @method static Builder|Client whereId($value)
 * @method static Builder|Client whereRefreshToken($value)
 * @method static Builder|Client whereToken($value)
 * @method static Builder|Client whereUpdatedAt($value)
 * @method static Builder|Client whereUsedAt($value)
 * @property string $description
 * @method static Builder|Client whereDescription($value)
 * @property-read Collection|Config[] $configs
 * @property-read int|null $configs_count
 */
class Client extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'token',
        'refresh_token',
        'description',
        'domains',
        'used_at',
        'expired_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'token'         => 'encrypted',
        'refresh_token' => 'encrypted',
        'domains'       => 'array',
        'used_at'       => 'datetime',
        'expired_at'    => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'token',
        'refresh_token',
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted()
    {
        static::creating(function ($client) {
            $client->client_id = static::generateClientId();
            $client->token = Str::random(32);
            $client->refresh_token = Str::random(50);
        });
    }

    /**
     * @return string
     */
    protected static function generateClientId(): string
    {
        $clientId = Str::random();
        if (self::where('client_id', $clientId)->first()) {
            $clientId = static::generateClientId();
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

    /**
     * The configs that belong to the client.
     */
    public function configs(): HasMany
    {
        return $this->hasMany(Config::class);
    }
}
