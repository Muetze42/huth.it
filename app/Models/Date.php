<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Date
 *
 * @property int $id
 * @property int $category_id
 * @property int $notified
 * @property int $notified2
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\DateCategory $category
 * @method static \Illuminate\Database\Eloquent\Builder|Date newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Date newQuery()
 * @method static \Illuminate\Database\Query\Builder|Date onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Date query()
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereNotified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereNotified2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Date withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Date withoutTrashed()
 * @mixin \Eloquent
 */
class Date extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notified',
        'notified2',
        'date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the category that owns the date.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(DateCategory::class, 'category_id');
    }
}
