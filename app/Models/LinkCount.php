<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkCount extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'os',
        'client',
        'ip',
    ];

    /**
     * Get the link that owns the count.
     */
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
