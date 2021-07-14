<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class usertableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Admin',
            'email' => 'cntt.phanmem@btpholdings.vn',
            'password' => Hash::make('Btp@123456'),
            'level' => '1',
            'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'username' => 'tien.lh',
            'email' => 'tien.lh@btpholdings.vn',
            'password' => Hash::make('Btp@123456'),
            'level' => '2',
            'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'username' => 'luu',
            'email' => 'luu@btpholdings.vn',
            'password' => Hash::make('Btp@123456'),
            'level' => '2',
            'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
