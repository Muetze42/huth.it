<?php

namespace App\Console\Commands\Nova;

use App\Traits\Command\GeneratorCommand;
use Laravel\Nova\Console\ValueCommand as Command;

class ValueCommand extends Command
{
    use GeneratorCommand;
}
