<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $tags = [
            "console",
            "inertiajs",
            "laravel",
            "laravel-nova",
            "laravel-nova-3",
            "laravel-nova-4",
            "php",
            "tailwindcss",
            "vuejs",
            "vuejs3",
        ];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
