<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Link;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Link::create([
            'active' => true,
            'icon'   => 'fab fa-instagram',
            'name'   => 'Instagram',
            'target' => 'https://www.instagram.com/muetze_official',
            'color'  => '#e1306c',
        ]);
        Link::create([
            'active' => true,
            'icon'   => 'fab fa-github',
            'name'   => 'GitHub',
            'target' => 'https://github.com/Muetze42',
            'color'  => '#4078c0',
        ]);
        Link::create([
            'active' => true,
            'icon'   => 'fab fa-linkedin',
            'name'   => 'LinkedIn',
            'target' => 'https://www.linkedin.com/in/normanhuth/',
            'color'  => '#0077b5',
        ]);
        Link::create([
            'active' => true,
            'icon'   => 'fab fa-steam',
            'name'   => 'Steam',
            'target' => 'https://www.linkedin.com/in/normanhuth/',
            'color'  => '#00adee',
        ]);
        Link::create([
            'active' => true,
            'icon'   => 'fab fa-twitch',
            'name'   => 'Twitch',
            'target' => 'https://twitch.huth.it',
            'color'  => '#6441a5',
        ]);
    }
}
