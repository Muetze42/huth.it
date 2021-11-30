<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TrashMail
 *
 * @property int $id
 * @property string $provider
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|TrashMail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrashMail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrashMail query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrashMail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrashMail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrashMail whereProvider($value)
 * @mixin \Eloquent
 */
class TrashMail extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'provider',
    ];
}
