<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Browser extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    const DEVICE_TYPE_UNKNOWN = null;
    const DEVICE_TYPE_MOBILE = 1;
    const DEVICE_TYPE_TABLET = 2;
    const DEVICE_TYPE_DESKTOP = 3;

    const OS_UNKNOWN = null;
    const OS_WINDOWS = 1;
    const OS_LINUX = 2;
    const OS_MAC = 3;
    const OS_ANDROID = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_type',
        'is_bot',
        'os',
        'browser_name',
        'browser_family',
        'browser_version',
        'browser_version_major',
        'browser_version_minor',
        'browser_version_patch',
        'browser_engine',
        'platform_name',
        'platform_family',
        'platform_version',
        'plattform_version_major',
        'plattform_version_minor',
        'plattform_version_patch',
        'device_family',
        'device_model',
        'mobile_grade',
        'ip',
    ];
}
