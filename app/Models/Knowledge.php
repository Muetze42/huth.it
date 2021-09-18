<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Tags\HasTags;

class Knowledge extends Model
{
    use HasFactory, HasTags;

    /**
     * Get the author of the knowledge entry.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
