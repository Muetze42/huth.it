<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferrerHost extends Model
{
    use HasFactory, SoftDeletes;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'referrer_count',
    ];

    /**
     * Get the referrers for the host.
     */
    public function referrers(): HasMany
    {
        return $this->hasMany(Referrer::class);
    }
}
