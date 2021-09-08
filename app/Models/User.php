<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
     * Get the user's first name.
     *
     * @param mixed $value
     * @return array
     */
    public function getGoogleTokenAttribute(mixed $value): array
    {
        if (is_string($value)) {
            return json_decode(decrypt($value), true);
        }
        return $value;
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
}
