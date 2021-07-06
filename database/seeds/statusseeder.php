<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class statusseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'title' => '',
        ]);
        DB::table('status')->insert([
            'title' => 'Quá hạn',
        ]);
        DB::table('status')->insert([
            'title' => 'Đã gia hạn',
        ]);
        DB::table('status')->insert([
            'title' => 'Xoá',
        ]);
    }
}
