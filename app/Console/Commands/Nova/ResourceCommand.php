<?php

namespace App\Console\Commands\Nova;

use Laravel\Nova\Console\ResourceCommand as Command;

class ResourceCommand extends Command
{
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Nova\Resources';
    }
}
