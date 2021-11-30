<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Telegram
 *
 * @property int $id
 * @property int $telegram_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Telegram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Telegram newQuery()
 * @method static \Illuminate\Database\Query\Builder|Telegram onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Telegram query()
 * @method static \Illuminate\Database\Eloquent\Builder|Telegram whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telegram whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telegram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telegram whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telegram whereTelegramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telegram whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Telegram withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Telegram withoutTrashed()
 * @mixin \Eloquent
 */
class Telegram extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'telegram_id',
        'name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'telegram_id' => 'integer',
    ];
}
