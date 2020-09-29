<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesTableSeeder::class);//creo primero los roles porqe si creo el usuario primero sin rol no se podria
         $this->call(UsersTableSeeder::class);
         $this->call(ThemesTableSeeder::class);
         $this->call(ArticlesTableSeeder::class);
    }
}
