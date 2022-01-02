<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ConfigItem
 *
 * @property int $id
 * @property int $config_id
 * @property int $type
 * @property string $key
 * @property mixed|null $content
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|ConfigItem[] $children
 * @property-read int|null $children_count
 * @property-read ConfigItem $config
 * @property-read mixed $content_casted
 * @property-read ConfigItem|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereConfigId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|ConfigItem[] $items
 * @property-read int|null $items_count
 */
class ConfigItem extends Model
{
    use HasFactory;

    const TYPE_KEY = 0;
    const TYPE_STRING = 1;
    const TYPE_BOOL = 2;
    const TYPE_INT = 3;
    const TYPE_NULL = 4;
    const TYPE_FLOAT = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'key',
        'content',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'content_casted'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'encrypted',
    ];

    /**
     * Get casted content attribute
     *
     * @return float|bool|int|string|null
     */
    public function getContentCastedAttribute(): float|bool|int|string|null
    {
        return match ($this->type) {
            self::TYPE_BOOL => (bool)$this->content,
            self::TYPE_INT => (int)$this->content,
            self::TYPE_NULL => null,
            self::TYPE_FLOAT => (float)$this->content,
            default => (string)$this->content,
        };
    }

    /**
     * Get the config that owns the items.
     */
    public function config(): BelongsTo
    {
        return $this->belongsTo(Config::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
