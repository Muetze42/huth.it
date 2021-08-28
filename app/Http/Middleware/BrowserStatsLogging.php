<?php

namespace App\Http\Middleware;

use App\Traits\ErrorExceptionNotify;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Browser as BrowserDetection;
use App\Models\Browser;

class BrowserStatsLogging
{
    use ErrorExceptionNotify;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        try {
            $browser = BrowserDetection::detect();

            if ($browser->isMobile()) {
                $deviceType = Browser::DEVICE_TYPE_MOBILE;
            } elseif ($browser->isTablet()) {
                $deviceType = Browser::DEVICE_TYPE_TABLET;
            } elseif ($browser->isDesktop()) {
                $deviceType = Browser::DEVICE_TYPE_DESKTOP;
            } else {
                $deviceType = Browser::DEVICE_TYPE_UNKNOWN;
            }

            if ($browser->isWindows()) {
                $oSystem = Browser::OS_WINDOWS;
            } elseif ($browser->isLinux()) {
                $oSystem = Browser::OS_LINUX;
            } elseif ($browser->isMac()) {
                $oSystem = Browser::OS_MAC;
            } elseif ($browser->isAndroid()) {
                $oSystem = Browser::OS_ANDROID;
            } else {
                $oSystem = Browser::OS_UNKNOWN;
            }

            $deviceFamily = $browser->deviceFamily();

            if (!$oSystem) {
                return $next($request);
            }

            Browser::firstOrCreate([
                'device_type'             => $deviceType,
                'is_bot'                  => $browser->isBot(),
                'os'                      => $oSystem,
                'browser_name'            => $browser->browserName(),
                'browser_family'          => $browser->browserFamily(),
                'browser_version'         => $browser->browserVersion(),
                'browser_version_major'   => $browser->browserVersionMajor(),
                'browser_version_minor'   => $browser->browserVersionMinor(),
                'browser_version_patch'   => $browser->browserVersionPatch(),
                'browser_engine'          => $browser->browserEngine(),
                'platform_name'           => $browser->platformName(),
                'platform_family'         => $browser->platformFamily(),
                'platform_version'        => $browser->platformVersion(),
                'plattform_version_major' => $browser->platformVersionMajor(),
                'plattform_version_minor' => $browser->platformVersionMinor(),
                'plattform_version_patch' => $browser->platformVersionPatch(),
                'device_family'           => $deviceFamily && strtolower($deviceFamily) != 'unknown' ? $deviceFamily : null,
                'device_model'            => $browser->deviceModel(),
                'mobile_grade'            => $browser->mobileGrade(),
                'ip'                      => md5(getClientIp()),
            ]);

        } catch (\Exception $exception) {
            try {
                systemLog('App\Http\Middleware\BrowserStatsLogging:'. $exception->__toString());
                $this->sendTelegramMessage($exception);
            } catch (\Exception $exception) {
                Log::error($exception);
                $this->sendTelegramMessage($exception);
            }
        }

        return $next($request);
    }
}
