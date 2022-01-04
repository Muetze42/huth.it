<?php

namespace App\Models;

use NormanHuth\ConsumerApiAdministration\app\Models\Client as Model;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $client_id
 * @property mixed $token
 * @property mixed $refresh_token
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $expired_at
 * @property \Illuminate\Support\Carbon|null $used_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\NormanHuth\ConsumerApiAdministration\app\Models\Config[] $configs
 * @property-read int|null $configs_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\NormanHuth\ConsumerApiAdministration\app\Models\Repository[] $repositories
 * @property-read int|null $repositories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUsedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\NormanHuth\ConsumerApiAdministration\app\Models\Domain[] $domains
 * @property-read int|null $domains_count
 */
class Client extends Model
{
    //
}
