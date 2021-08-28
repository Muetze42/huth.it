<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referrer extends Model
{
    use HasFactory, SoftDeletes;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'ip',
    ];

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();
        static::created(function ($referrer) {
            $referrer->host->update(['referrer_count' => $referrer->host->referrers->count()]);
        });
    }

    /**
     * Get the host that owns the referrer.
     */
    public function host(): BelongsTo
    {
        return $this->belongsTo(ReferrerHost::class, 'referrer_host_id');
    }
}
