<?php

namespace App\Helpers;

class UrlGenerator extends \Illuminate\Routing\UrlGenerator
{
    /**
     * Generate the URL to an application asset.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    public function asset($path, $secure = null): string
    {
        if ($this->isValidUrl($path)) {
            return $path;
        }

        // Once we get the root URL, we will check to see if it contains an index.php
        // file in the paths. If it does, we will remove it since it is not needed
        // for asset paths, but only for routes to endpoints in the application.
        $root = $this->assetRoot ?: $this->formatRoot($this->formatScheme($secure));

        $path = trim($path, '/');
        $file = public_path($path);
        if (!str_starts_with($path, 'build/') && file_exists($file)) {
            $path.= '?h='.md5_file($file);
        }

        return $this->removeIndex($root).'/'.$path;
    }
}
