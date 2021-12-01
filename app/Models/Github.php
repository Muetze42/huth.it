<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * App\Models\Github
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Github newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Github newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Github query()
 * @mixin \Eloquent
 */
class Github extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event',
        'action',
        'slug',
        'secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'slug'   => 'encrypted',
        'secret' => 'encrypted'
    ];

    /**
     * Get all the notifications that are assigned this tag.
     */
    public function notifications(): MorphToMany
    {
        // Todo: Github <- notifications ->
        // return $this->morphedByMany(Notification::class, 'taggable');
    }
}