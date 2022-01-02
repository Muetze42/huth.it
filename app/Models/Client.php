<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

/**
 * App\Models\Client
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $client_id
 * @property mixed $token
 * @property mixed $refresh_token
 * @property \Illuminate\Support\Carbon|null $expired_at
 * @property \Illuminate\Support\Carbon|null $used_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Client[] $repositories
 * @property-read int|null $repositories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUsedAt($value)
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDescription($value)
 */
class Client extends Authenticatable
{
    use HasFactory;

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
}
