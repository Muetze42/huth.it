<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Repository
 *
 * @property int $id
 * @property int $github_id
 * @property string $name
 * @property string|null $description
 * @property string|null $homepage
 * @property string|null $language
 * @property int $stargazers_count
 * @property int $watchers_count
 * @property int $forks
 * @property int $open_issues
 * @property int $watchers
 * @property bool $fork
 * @property bool $archived
 * @property array|null $topics
 * @property \Illuminate\Support\Carbon|null $github_created_at
 * @property \Illuminate\Support\Carbon|null $github_updated_at
 * @property \Illuminate\Support\Carbon|null $github_pushed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Repository newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Repository newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Repository query()
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereArchived($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereFork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereForks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereGithubCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereGithubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereGithubPushedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereGithubUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereOpenIssues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereStargazersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereTopics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereWatchers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereWatchersCount($value)
 * @mixin \Eloquent
 * @property int|null $rating
 * @property int|null $rating_count
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereRatingCount($value)
 * @property int $stars
 * @property int|null $packagist_downloads
 * @method static \Illuminate\Database\Eloquent\Builder|Repository wherePackagistDownloads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereStars($value)
 * @property string|null $novapackages_url
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereNovapackagesUrl($value)
 */
class Repository extends Model
{
    use HasFactory;

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
        'fork',
        'archived',
        'topics',
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
        'topics'              => 'array',
        'github_created_at'   => 'datetime',
        'github_updated_at'   => 'datetime',
        'github_pushed_at'    => 'datetime',
    ];
}
