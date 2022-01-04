<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\DateCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Date[] $dates
 * @property-read int|null $dates_count
 * @method static \Illuminate\Database\Eloquent\Builder|DateCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DateCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|DateCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DateCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|DateCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DateCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DateCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DateCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DateCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|DateCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|DateCategory withoutTrashed()
 * @mixin \Eloquent
 */
class DateCategory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the dates for the category.
     */
    public function dates(): HasMany
    {
        return $this->hasMany(Date::class, 'category_id');
    }
}
