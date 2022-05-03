<?php

namespace App\Console\Commands\Nova;

use App\Traits\Command\GeneratorCommand;
use Laravel\Nova\Console\FilterCommand as Command;

class FilterCommand extends Command
{
    use GeneratorCommand;
}
