<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TwitchDocumentationChangelog
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $date
 * @property string $changes
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchDocumentationChangelog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchDocumentationChangelog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchDocumentationChangelog query()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchDocumentationChangelog whereChanges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchDocumentationChangelog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchDocumentationChangelog whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchDocumentationChangelog whereId($value)
 * @mixin \Eloquent
 */
class TwitchDocumentationChangelog extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'date',
        'changes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];
}
