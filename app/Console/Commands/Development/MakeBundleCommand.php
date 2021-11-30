<?php

namespace App\Console\Commands\Development;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeBundleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:bundle {name}
                            {--n : create with nova resource}
                            {--m : create with migration}
                            {--p : create with policy}
                            {--r : create with resource}
                            {--c : create with controller}
                            {--a : create with api controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class, a new nova resource class and optional a new migration file and a new policy class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $migration = $this->option('m') || config('muetze-site.make-bundle.migration', true);
        $policy = $this->option('p') || config('muetze-site.make-bundle.policy', true);
        $resource = $this->option('r') || config('muetze-site.make-bundle.resource', true);
        $nova = $this->option('n') || config('muetze-site.make-bundle.nova-ressource', false);
        $controller = $this->option('c') || config('muetze-site.make-bundle.controller', false);
        $apiController = $this->option('a') || config('muetze-site.make-bundle.api-controller', false);

        $name = $this->argument('name');
        $model = ucfirst(Str::singular($name));
        $table = Str::snake(Str::pluralStudly(class_basename($name)));

        $this->line(__('Create model: :model', ['model' => $model]));
        $this->call('make:model', [
            'name' => $model,
        ]);

        if ($policy) {
            $this->line(__('Create policy: :model', ['model' => $model]));
            $this->call('make:policy', [
                'name' => sprintf('%sPolicy', $model),
                '--model' => $model,
            ]);
        }

        if ($nova) {
            $this->line(__('Create nova resource: :model', ['model' => $model]));
            $this->call('nova:resource', [
                'name' => $model,
            ]);
        }

        if ($resource) {
            $this->line(__('Create resource: :model', ['model' => $model]));
            $this->call('make:resource', [
                'name' => $model.'Resource',
            ]);
        }

        if ($controller) {
            $this->line(__('Create controller: :model', ['model' => $model]));
            $this->call('make:controller', [
                'name' => config('muetze-site.make-bundle.namespaces.controller').$model.'Controller',
                '--resource' => true,
            ]);
        }

        if ($apiController) {
            $this->line(__('Create API controller: :model', ['model' => $model]));
            $this->call('make:controller', [
                'name' => config('muetze-site.make-bundle.namespaces.api-controller').$model.'Controller',
                '--api' => true,
                '--resource' => true,
            ]);
        }

        if ($migration) {
            $this->line(__('Create migration: :table', ['table' => $table]));
            $this->call('make:migration', [
                'name' => 'create_'.$table.'_table',
                '--create' => $table,
            ]);
        }


        return 0;
    }
}
