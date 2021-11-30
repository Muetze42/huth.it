<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RepoWatch
 *
 * @property int $id
 * @property string $name
 * @property string|null $version
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RepoWatch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RepoWatch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RepoWatch query()
 * @method static \Illuminate\Database\Eloquent\Builder|RepoWatch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepoWatch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepoWatch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepoWatch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepoWatch whereVersion($value)
 * @mixin \Eloquent
 */
class RepoWatch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'repo',
        'version',
    ];
}
