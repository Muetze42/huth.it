<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\LinkCount
 *
 * @property int $id
 * @property int $link_id
 * @property string $os
 * @property string $client
 * @property string|null $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \App\Models\Link $link
 * @method static \Illuminate\Database\Eloquent\Builder|LinkCount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkCount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkCount query()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkCount whereClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkCount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkCount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkCount whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkCount whereLinkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkCount whereOs($value)
 * @mixin \Eloquent
 */
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
