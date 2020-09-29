<?php

use Illuminate\Database\Seeder;
use App\Theme;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Theme::class,5)->create();//coloco esto para crear 5 usuarios ficticios
    }
}
