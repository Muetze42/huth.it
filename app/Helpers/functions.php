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

if (!function_exists('opensslEncrypt')) {
    function opensslEncrypt($string, $passphrase): string
    {
        $key = openssl_digest($passphrase, 'SHA256', true);

        $ivLength = openssl_cipher_iv_length('AES-256-CBC');
        $iv = openssl_random_pseudo_bytes($ivLength);
        $ciphertextRaw = openssl_encrypt($string, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

        $hmac = hash_hmac('sha256', $ciphertextRaw, $key, true);

        return base64_encode($iv . $hmac . $ciphertextRaw);
    }
}

if (!function_exists('opensslDecrypt')) {
    function opensslDecrypt($data, $passphrase): string|null
    {
        $data = base64_decode($data);

        $key = openssl_digest($passphrase, 'SHA256', TRUE);

        $ivLength = openssl_cipher_iv_length('AES-256-CBC');

        $iv = substr($data, 0, $ivLength);
        $hmac = substr($data, $ivLength, $sha2len = 32);
        $ciphertext_raw = substr($data, $ivLength + $sha2len);
        $text = openssl_decrypt($ciphertext_raw, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

        $hashHmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
        if (hash_equals($hmac, $hashHmac)) {
            return $text;
        }

        return null;
    }
}

if (!function_exists('removeUri')) {
    function removeUri(string $url): string
    {
        $parts = parse_url($url);

        return $parts['scheme'].'://'.$parts['host'];
    }
}
