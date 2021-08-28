<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Referrer;
use App\Models\ReferrerHost;

class VisitorsStatsLogging
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $referer = trim($request->headers->get('referer'));

        try {
            $domain = $this->getDomain($referer);

            if ($referer && $referer!='null' && $domain != $request->server('SERVER_NAME') && $domain != $request->server('SERVER_ADDR')) {

                $host = ReferrerHost::firstOrCreate(['name' => $domain]);

                $data = [
                    'url' => $referer,
                    'ip'  => md5(getClientIp()),
                ];

                $check = $host->referrers()->where($data)->whereNotNull('ip')->first();

                if (!$check) {
                    $host->referrers()->create($data);
                }
            }
        } catch (\Exception $exception) {
            try {
                systemLog('App\Http\Middleware\VisitorsStatsLogging:'. $exception->__toString());
            } catch (\Exception $exception) {
                Log::error($exception);
            }
        }

        return $next($request);
    }

    /**
     * @param string|null $url
     * @return string
     */
    protected function getDomain(?string $url): string
    {
        $pieces = parse_url($url);
        $domain = $pieces['host'] ?? '';
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return $domain;
    }
}
