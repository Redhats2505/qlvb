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
        // $this->call(UsersTableSeeder::class);
         $this->call(statusseeder::class);
         $this->call(usertableseeder::class);
         $this->call(user_leveltableseeder::class);
         $this->call(document_countrySeeder::class);
         $this->call(document_groupSeeder::class);
         $this->call(document_ownerSeeder::class);
         $this->call(document_typesSeeder::class);
    }
}
