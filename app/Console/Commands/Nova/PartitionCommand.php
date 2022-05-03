<?php

namespace App\Console\Commands\Nova;

use App\Traits\Command\GeneratorCommand;
use Laravel\Nova\Console\PartitionCommand as Command;

class PartitionCommand extends Command
{
    use GeneratorCommand;
}
