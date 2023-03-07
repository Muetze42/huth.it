<?php

namespace App\Models;

use App\Traits\HasTags;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Package
 *
 * @property int $id
 * @property int|null $github_id
 * @property string $name
 * @property string|null $description
 * @property string|null $homepage
 * @property string|null $language
 * @property string|null $novapackages_url
 * @property int $stars
 * @property int $forks
 * @property int $open_issues
 * @property int $watchers
 * @property int|null $rating
 * @property int|null $rating_count
 * @property int|null $packagist_downloads
 * @property array|null $topics
 * @property bool $fork
 * @property bool $archived
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $github_created_at
 * @property \Illuminate\Support\Carbon|null $github_updated_at
 * @property \Illuminate\Support\Carbon|null $github_pushed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static Builder|Package active()
 * @method static Builder|Package newModelQuery()
 * @method static Builder|Package newQuery()
 * @method static \Illuminate\Database\Query\Builder|Package onlyTrashed()
 * @method static Builder|Package query()
 * @method static Builder|Package whereActive($value)
 * @method static Builder|Package whereArchived($value)
 * @method static Builder|Package whereCreatedAt($value)
 * @method static Builder|Package whereDeletedAt($value)
 * @method static Builder|Package whereDescription($value)
 * @method static Builder|Package whereFork($value)
 * @method static Builder|Package whereForks($value)
 * @method static Builder|Package whereGithubCreatedAt($value)
 * @method static Builder|Package whereGithubId($value)
 * @method static Builder|Package whereGithubPushedAt($value)
 * @method static Builder|Package whereGithubUpdatedAt($value)
 * @method static Builder|Package whereHomepage($value)
 * @method static Builder|Package whereId($value)
 * @method static Builder|Package whereLanguage($value)
 * @method static Builder|Package whereName($value)
 * @method static Builder|Package whereNovapackagesUrl($value)
 * @method static Builder|Package whereOpenIssues($value)
 * @method static Builder|Package wherePackagistDownloads($value)
 * @method static Builder|Package whereRating($value)
 * @method static Builder|Package whereRatingCount($value)
 * @method static Builder|Package whereStars($value)
 * @method static Builder|Package whereTopics($value)
 * @method static Builder|Package whereUpdatedAt($value)
 * @method static Builder|Package whereWatchers($value)
 * @method static \Illuminate\Database\Query\Builder|Package withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Package withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|Package[] $packages
 * @property-read int|null $packages_count
 */
class Package extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTags;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'github_id',
        'name',
        'description',
        'homepage',
        'language',
        'novapackages_url',
        'stars',
        'forks',
        'open_issues',
        'watchers',
        'rating',
        'rating_count',
        'packagist_downloads',
        'topics',
        'fork',
        'archived',
        'active',
        'github_created_at',
        'github_updated_at',
        'github_pushed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'github_id'           => 'int',
        'stars'               => 'int',
        'forks'               => 'int',
        'open_issues'         => 'int',
        'watchers'            => 'int',
        'rating'              => 'int',
        'rating_count'        => 'int',
        'packagist_downloads' => 'int',
        'fork'                => 'bool',
        'archived'            => 'bool',
        'active'              => 'bool',
        'topics'              => 'array',
        'github_created_at'   => 'datetime',
        'github_updated_at'   => 'datetime',
        'github_pushed_at'    => 'datetime',
    ];

    /**
     * Scope a query to only include active users.
     *
     * @param Builder $query
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }
}
