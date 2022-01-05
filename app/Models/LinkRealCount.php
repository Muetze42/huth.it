<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\LinkRealCount
 *
 * @property int $id
 * @property int $link_id
 * @property string $os
 * @property string $client
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \App\Models\Link $link
 * @method static \Illuminate\Database\Eloquent\Builder|LinkRealCount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkRealCount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkRealCount query()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkRealCount whereClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkRealCount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkRealCount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkRealCount whereLinkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkRealCount whereOs($value)
 * @mixin \Eloquent
 */
class LinkRealCount extends Model
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
    ];

    /**
     * Get the link that owns the count.
     */
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
