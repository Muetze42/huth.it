<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Tags\HasTags;

/**
 * App\Models\Bookmark
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string|null $description
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BookmarkCategory $category
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark withAnyTagsOfAnyType($tags)
 * @mixin \Eloquent
 */
class Bookmark extends Model
{
    use HasFactory, HasTags;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'description',
    ];

    /**
     * Get the category that owns the bookmark.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BookmarkCategory::class);
    }
}
