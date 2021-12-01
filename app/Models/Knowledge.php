<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Tags\HasTags;

/**
 * App\Models\Knowledge
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge query()
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge withAnyTagsOfAnyType($tags)
 * @mixin \Eloquent
 */
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
