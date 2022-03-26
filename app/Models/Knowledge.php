<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Knowledge
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $author
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge newQuery()
 * @method static \Illuminate\Database\Query\Builder|Knowledge onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge query()
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Knowledge whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Knowledge withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Knowledge withoutTrashed()
 * @mixin \Eloquent
 */
class Knowledge extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
    ];

    /**
     * Get the author of the knowledge entry.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
