<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Repository
 *
 * @method static Builder|Repository newModelQuery()
 * @method static Builder|Repository newQuery()
 * @method static Builder|Repository query()
 * @mixin Eloquent
 * @property int $id
 * @property string $repo
 * @property string $branch
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Repository[] $clients
 * @property-read int|null $clients_count
 * @method static Builder|Repository whereBranch($value)
 * @method static Builder|Repository whereCreatedAt($value)
 * @method static Builder|Repository whereDescription($value)
 * @method static Builder|Repository whereId($value)
 * @method static Builder|Repository whereRepo($value)
 * @method static Builder|Repository whereUpdatedAt($value)
 */
class Repository extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'repo',
        'branch',
        'description',
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted()
    {
        static::saving(function ($repository) {
            $repository->repo = basename($repository->repo);
        });
    }

    /**
     * The clients that belong to the repository.
     */
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class);
    }
}
