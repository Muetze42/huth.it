<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Config
 *
 * @property int $id
 * @property int $client_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read Collection|\App\Models\ConfigItem[] $items
 * @property-read int|null $items_count
 * @method static Builder|Config newModelQuery()
 * @method static Builder|Config newQuery()
 * @method static Builder|Config query()
 * @method static Builder|Config whereClientId($value)
 * @method static Builder|Config whereCreatedAt($value)
 * @method static Builder|Config whereId($value)
 * @method static Builder|Config whereName($value)
 * @method static Builder|Config whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Config extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'client_id',
//    ];

    /**
     * The client that belong to the config.
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the config items for the config.
     */
    public function items(): HasMany
    {
        return $this->hasMany(ConfigItem::class);
    }
}
