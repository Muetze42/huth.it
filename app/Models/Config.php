<?php

namespace App\Models;

use NormanHuth\ConsumerApiAdministration\app\Models\Config as Model;

/**
 * App\Models\Config
 *
 * @property int $id
 * @property int $client_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \NormanHuth\ConsumerApiAdministration\app\Models\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\NormanHuth\ConsumerApiAdministration\app\Models\ConfigItem[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Config newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Config newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Config query()
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Config extends Model
{
    //
}
