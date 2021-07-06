<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class user_leveltableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_level')->insert([
            'title' => 'Super_admin',
        ]);
        DB::table('user_level')->insert([
            'title' => 'Admin',

        ]);
        DB::table('user_level')->insert([
            'title' => 'Member',
        ]);
    }
}
