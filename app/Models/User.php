<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'github_id',
        'google_token',
        'email',
        'password',
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function ($user) {
            $user->google_token = encrypt(json_encode($user->google_token));
        });
    }

    /**
     * Get Google Token decrypt and as array
     *
     * @param mixed $value
     * @return array
     */
    public function getGoogleTokenAttribute(mixed $value): array
    {
        if (is_string($value)) {
            return json_decode(decrypt($value), true);
        }
        if (!empty($value) && is_array($value)) {
            return $value;
        }
        return [];
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the knowledge entries by the user.
     */
    public function knowledge(): HasOne
    {
        return $this->hasOne(Knowledge::class);
    }
}
