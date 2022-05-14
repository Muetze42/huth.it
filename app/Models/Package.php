<?php

namespace App\Models;

use App\Traits\Model\HasTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Repository
 *
 * @property int $id
 * @property string|null $description
 * @property string $source
 * @property string $version
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newQuery()
 * @method static \Illuminate\Database\Query\Builder|Package onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|Package withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Package withoutTrashed()
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $pushed_at
 * @method static \Illuminate\Database\Eloquent\Builder|Package wherePushedAt($value)
 * @property string $name
 * @property string $github
 * @property string $packagist
 * @property string|null $parent
 * @property int $downloads
 * @property int $stars
 * @property int $forks
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDownloads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereForks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereGithub($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package wherePackagist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereStars($value)
 * @property int $watchers
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereWatchers($value)
 * @property \Illuminate\Support\Carbon|null $released_at
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereReleasedAt($value)
 * @property string|null $homepage
 * @property string|null $np_rating
 * @property int $np_rates
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereNpRates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereNpRating($value)
 */
class Package extends Model
{
    use HasFactory, SoftDeletes, HasTags;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'github',
        'packagist',
        'version',
        'downloads',
        'parent',
        'homepage',
        'np_rating',
        'np_rates',
        'stars',
        'forks',
        'watchers',
        'pushed_at',
        'released_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'np_rating'   => 'decimal:2',
        'np_rates'    => 'int',
        'downloads'   => 'int',
        'stars'       => 'int',
        'forks'       => 'int',
        'watchers'    => 'int',
        'pushed_at'   => 'datetime',
        'released_at' => 'datetime',
    ];
}
