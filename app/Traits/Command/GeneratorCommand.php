<?php

namespace App\Traits\Command;

trait GeneratorCommand
{
    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name): string
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);
        $name = str_replace(['Filter', 'Metric'], '', $class);
        $replace = $name ?: $class;
        $stub = str_replace(['{{Name}}', '{{ Name }}'], $replace, $stub);

        return str_replace(['DummyClass', '{{ class }}', '{{class}}'], $class, $stub);
    }
}
