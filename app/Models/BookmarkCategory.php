<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\BookmarkCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bookmark[] $bookmarks
 * @property-read int|null $bookmarks_count
 * @method static \Illuminate\Database\Eloquent\Builder|BookmarkCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookmarkCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookmarkCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookmarkCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookmarkCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookmarkCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookmarkCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BookmarkCategory extends Model
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
     * Get the bookmarks for the category.
     */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class, 'category_id');
    }
}
