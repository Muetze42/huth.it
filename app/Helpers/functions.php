<?php

if (!function_exists('gerateAdditionalStylesheet')) {
    /**
     * @throws \ScssPhp\ScssPhp\Exception\SassException
     */
    function gerateAdditionalStylesheet()
    {
        $buttons = \App\Models\Link::where('active', true)->get();
        $compiler = new \ScssPhp\ScssPhp\Compiler();
        $compiler->setOutputStyle(\ScssPhp\ScssPhp\OutputStyle::COMPRESSED);

        $source = '.btn {';
        foreach ($buttons as $button) {
            $source.= '&.btn-'.$button->id.' {';
            $source.= 'background-color: '.$button->color.';';
            $source.= ' &:hover { background-color: lighten('.$button->color.', 10%); }';
            $source.= '}';
        }
        $source.= '}';

        $result = $compiler->compileString($source);

        file_put_contents(public_path('css/buttons.map'), $result->getSourceMap());
        file_put_contents(public_path('css/buttons.css'), $result->getCss());

    }
}

if (!function_exists('systemLog')) {
    function systemLog(mixed $message, string $severity = 'error')
    {
        $severity = severityCheck($severity);

        if (is_array($message) || is_object($message)) {
            $message = print_r($message, true);
        }

        \Illuminate\Support\Facades\Log::$severity($message);
    }
}

if(!function_exists('severityCheck')) {
    function severityCheck($severity): string
    {
        $severities = [
            'emergency',
            'alert',
            'critical',
            'error',
            'warning',
            'notice',
            'info',
            'debug',
        ];

        return in_array($severity, $severities) ? $severity : 'error';
    }
}

function lastAnd(string $string, string $word = 'und', string $glue = ','): string
{
    if (!preg_match('/,/', $string)) {
        return $string;
    }
    return substr_replace($string, ' '.$word, strrpos($string, $glue), 1);
}

if (!function_exists('MinifyHtml')) {
    /**
     * https://stackoverflow.com/questions/27878158/php-bufffer-output-minify-not-textarea-pre
     *
     * @param $buffer
     * @return mixed
     */
    function MinifyHtml($buffer): mixed
    {
        preg_match_all('#<textarea.*>.*</textarea>#Uis', $buffer, $foundTxt);
        preg_match_all('#<pre.*>.*</pre>#Uis', $buffer, $foundPre);

        $buffer = str_replace($foundTxt[0], array_map(function ($elm) {
            return '<textarea>'.$elm.'</textarea>';
        }, array_keys($foundTxt[0])), $buffer);
        $buffer = str_replace($foundPre[0], array_map(function ($elm) {
            return '<pre>'.$elm.'</pre>';
        }, array_keys($foundPre[0])), $buffer);

        // your stuff
        $search = array(
            '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
            '/[^\S ]+\</s',  // strip whitespaces before tags, except space
            '/(\s)+/s',      // shorten multiple whitespace sequences
        );

        $replace = array(
            '>',
            '<',
            '\\1',
        );

        $buffer = preg_replace($search, $replace, $buffer);

        // Replacing back with content
        $buffer = str_replace(array_map(function ($elm) {
            return '<textarea>'.$elm.'</textarea>';
        }, array_keys($foundTxt[0])), $foundTxt[0], $buffer);
        $buffer = str_replace(array_map(function ($elm) {
            return '<pre>'.$elm.'</pre>';
        }, array_keys($foundPre[0])), $foundPre[0], $buffer);

        $buffer = str_replace('> <', '><', $buffer);
        $buffer = str_replace('<script type="text/javascript">', '<script>', $buffer);

        return preg_replace('/(<a href="(http|https):(?!\/\/(?:www\.)?daysndaze\.(test|net))[^"]+")>/is', '\\1 target="_blank">', $buffer);
    }
}

if (!function_exists('novaCat')) {
    /**
     * @param $category
     * @return string
     */
    function novaCat($category): string
    {
        return '<span class="hidden">'.config('site.nova.menu-order.'.$category, '999').'</span>'.e(__($category));
    }
}

if (!function_exists('errorImage')) {
    function errorImage(int $errorCode): string
    {
        $errorImages = [
            '401' => '403.svg',
            '403' => '403.svg',
            '404' => '404.svg',
            '500' => '503.svg',
        ];

        return $errorImages[$errorCode] ?? '404.svg';
    }
}

if (!function_exists('_asset')) {
    /**
     * @param $asset
     * @return string
     */
    function _asset($asset): string
    {
        $asset = trim($asset, '\\/');

        $file = public_path($asset);

        if (file_exists($file)) {
            return asset($asset).'?='.filemtime($file);
        }

        return $asset;
    }
}

if (!function_exists('jsonResponse')) {
    /**
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    function jsonResponse(string $message = 'Not found', int $status = 404): \Illuminate\Http\JsonResponse
    {
        if ($status >= 400) {
            return response()->json([
                'error'   => true,
                'message' => __($message),
                'time'    => now(),
            ], $status);
        }

        return response()->json([
            'message' => __($message),
            'time'    => now(),
        ], $status);
    }
}

if (!function_exists('getClientIp')) {
    /**
     * @return string
     */
    function getClientIp(): string
    {
        $keys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
        foreach ($keys as $k) {
            if (!empty(request()->server($k)) && filter_var(request()->server($k), FILTER_VALIDATE_IP)) {
                return request()->server($k);
            }
        }
        return 'Unknown';
    }
}

if (!function_exists('getClientOS')) {
    /**
     * @param string $userAgent
     * @return string
     */
    function getClientOS(string $userAgent = ''): string
    {
        if (!$userAgent) {
            $userAgent = request()->header('User-Agent');
        }

        // https://stackoverflow.com/questions/18070154/get-operating-system-info-with-php
        $osArray = [
            'windows nt 10'                             => 'Windows 10',
            'windows nt 6.3'                            => 'Windows 8.1',
            'windows nt 6.2'                            => 'Windows 8',
            'windows nt 6.1|windows nt 7.0'             => 'Windows 7',
            'windows nt 6.0'                            => 'Windows Vista',
            'windows nt 5.2'                            => 'Windows Server 2003/XP x64',
            'windows nt 5.1'                            => 'Windows XP',
            'windows xp'                                => 'Windows XP',
            'windows nt 5.0|windows nt5.1|windows 2000' => 'Windows 2000',
            'windows me'                                => 'Windows ME',
            'windows nt 4.0|winnt4.0'                   => 'Windows NT',
            'windows ce'                                => 'Windows CE',
            'windows 98|win98'                          => 'Windows 98',
            'windows 95|win95'                          => 'Windows 95',
            'win16'                                     => 'Windows 3.11',
            'mac os x 10.1[^0-9]'                       => 'Mac OS X Puma',
            'macintosh|mac os x'                        => 'Mac OS X',
            'mac_powerpc'                               => 'Mac OS 9',
            'linux'                                     => 'Linux',
            'ubuntu'                                    => 'Linux - Ubuntu',
            'iphone'                                    => 'iPhone',
            'ipod'                                      => 'iPod',
            'ipad'                                      => 'iPad',
            'android'                                   => 'Android',
            'blackberry'                                => 'BlackBerry',
            'webos'                                     => 'Mobile',

            '(media center pc).([0-9]{1,2}\.[0-9]{1,2})' => 'Windows Media Center',
            '(win)([0-9]{1,2}\.[0-9x]{1,2})'             => 'Windows',
            '(win)([0-9]{2})'                            => 'Windows',
            '(windows)([0-9x]{2})'                       => 'Windows',

            // Doesn't seem like these are necessary...not totally sure though..
            //'(winnt)([0-9]{1,2}\.[0-9]{1,2}){0,1}'=>'Windows NT',
            //'(windows nt)(([0-9]{1,2}\.[0-9]{1,2}){0,1})'=>'Windows NT', // fix by bg

            'Win 9x 4.90'                                           => 'Windows ME',
            '(windows)([0-9]{1,2}\.[0-9]{1,2})'                     => 'Windows',
            'win32'                                                 => 'Windows',
            '(java)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2})'            => 'Java',
            '(Solaris)([0-9]{1,2}\.[0-9x]{1,2}){0,1}'               => 'Solaris',
            'dos x86'                                               => 'DOS',
            'Mac OS X'                                              => 'Mac OS X',
            'Mac_PowerPC'                                           => 'Macintosh PowerPC',
            '(mac|Macintosh)'                                       => 'Mac OS',
            '(sunos)([0-9]{1,2}\.[0-9]{1,2}){0,1}'                  => 'SunOS',
            '(beos)([0-9]{1,2}\.[0-9]{1,2}){0,1}'                   => 'BeOS',
            '(risc os)([0-9]{1,2}\.[0-9]{1,2})'                     => 'RISC OS',
            'unix'                                                  => 'Unix',
            'os/2'                                                  => 'OS/2',
            'freebsd'                                               => 'FreeBSD',
            'openbsd'                                               => 'OpenBSD',
            'netbsd'                                                => 'NetBSD',
            'irix'                                                  => 'IRIX',
            'plan9'                                                 => 'Plan9',
            'osf'                                                   => 'OSF',
            'aix'                                                   => 'AIX',
            'GNU Hurd'                                              => 'GNU Hurd',
            '(fedora)'                                              => 'Linux - Fedora',
            '(kubuntu)'                                             => 'Linux - Kubuntu',
            '(ubuntu)'                                              => 'Linux - Ubuntu',
            '(debian)'                                              => 'Linux - Debian',
            '(CentOS)'                                              => 'Linux - CentOS',
            '(Mandriva).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)' => 'Linux - Mandriva',
            '(SUSE).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)'     => 'Linux - SUSE',
            '(Dropline)'                                            => 'Linux - Slackware (Dropline GNOME)',
            '(ASPLinux)'                                            => 'Linux - ASPLinux',
            '(Red Hat)'                                             => 'Linux - Red Hat',
            // Loads of Linux machines will be detected as unix.
            // Actually, all of the linux machines I've checked have the 'X11' in the User Agent.
            //'X11'=>'Unix',
            '(linux)'                                               => 'Linux',
            '(amigaos)([0-9]{1,2}\.[0-9]{1,2})'                     => 'AmigaOS',
            'amiga-aweb'                                            => 'AmigaOS',
            'amiga'                                                 => 'Amiga',
            'AvantGo'                                               => 'PalmOS',
            //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1}-([0-9]{1,2}) i([0-9]{1})86){1}'=>'Linux',
            //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1} i([0-9]{1}86)){1}'=>'Linux',
            //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1})'=>'Linux',
            '[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}'                    => 'Linux',
            '(webtv)/([0-9]{1,2}\.[0-9]{1,2})'                      => 'WebTV',
            'Dreamcast'                                             => 'Dreamcast OS',
            'GetRight'                                              => 'Windows',
            'go!zilla'                                              => 'Windows',
            'gozilla'                                               => 'Windows',
            'gulliver'                                              => 'Windows',
            'ia archiver'                                           => 'Windows',
            'NetPositive'                                           => 'Windows',
            'mass downloader'                                       => 'Windows',
            'microsoft'                                             => 'Windows',
            'offline explorer'                                      => 'Windows',
            'teleport'                                              => 'Windows',
            'web downloader'                                        => 'Windows',
            'webcapture'                                            => 'Windows',
            'webcollage'                                            => 'Windows',
            'webcopier'                                             => 'Windows',
            'webstripper'                                           => 'Windows',
            'webzip'                                                => 'Windows',
            'wget'                                                  => 'Windows',
            'Java'                                                  => 'Unknown',
            'flashget'                                              => 'Windows',

            // delete next line if the script show not the right OS
            //'(PHP)/([0-9]{1,2}.[0-9]{1,2})'=>'PHP',
            'MS FrontPage'                                          => 'Windows',
            '(msproxy)/([0-9]{1,2}.[0-9]{1,2})'                     => 'Windows',
            '(msie)([0-9]{1,2}.[0-9]{1,2})'                         => 'Windows',
            'libwww-perl'                                           => 'Unix',
            'UP.Browser'                                            => 'Windows CE',
            'NetAnts'                                               => 'Windows',
        ];

        // https://github.com/ahmad-sa3d/php-useragent/blob/master/core/user_agent.php
        $archRegex = '/\b(x86_64|x86-64|Win64|WOW64|x64|ia64|amd64|ppc64|sparc64|IRIX64)\b/ix';
        $arch = preg_match($archRegex, $userAgent) ? '64' : '32';

        foreach ($osArray as $regex => $value) {
            if (preg_match('{\b(' . $regex . ')\b}i', $userAgent)) {
                return $value . ' x' . $arch;
            }
        }

        return 'Unknown';
    }
}
