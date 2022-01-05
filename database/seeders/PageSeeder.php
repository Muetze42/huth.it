<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'route'          => 'home',
            'title'          => 'Norman Huth',
            'description'    => 'Website of Norman Huth',
            'robots'         => 3,
        ]);
        Page::create([
            'route'          => 'contact',
            'title'          => 'Contact',
            'description'    => 'Here you can contact Norman Huth',
            'robots'         => 3,
        ]);
    }
}
