<?php

namespace App\Models;

use NormanHuth\ConsumerApiAdministration\app\Models\Domain as Model;

/**
 * App\Models\Domain
 *
 * @property int $id
 * @property int $client_id
 * @property mixed $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \NormanHuth\ConsumerApiAdministration\app\Models\Client $client
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|Domain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Domain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Domain query()
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereUrl($value)
 * @mixin \Eloquent
 */
class Domain extends Model
{
    //
}
