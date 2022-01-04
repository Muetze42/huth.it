<?php

namespace App\Models;

use NormanHuth\ConsumerApiAdministration\app\Models\ConfigItem as Model;

/**
 * App\Models\ConfigItem
 *
 * @property int $id
 * @property int|null $config_id
 * @property int $type
 * @property string $key
 * @property mixed|null $content
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \NormanHuth\ConsumerApiAdministration\app\Models\Config|null $config
 * @property-read float|bool|int|string|null $content_casted
 * @property-read \Illuminate\Database\Eloquent\Collection|Model[] $items
 * @property-read int|null $items_count
 * @property-read Model|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereConfigId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ConfigItem extends Model
{
    //
}
