<?php

namespace App\Console\Commands\Nova;

use App\Traits\Command\GeneratorCommand;
use Laravel\Nova\Console\TrendCommand as Command;

class TrendCommand extends Command
{
    use GeneratorCommand;
}
