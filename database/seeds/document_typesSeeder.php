<?php

use Illuminate\Database\Seeder;

class document_typesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->insert([
            'name' => 'Sở hữu trí tuệ',
            'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('document_types')->insert([
            'name' => 'Hợp đồng',
            'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('document_types')->insert([
            'name' => 'Giấy phép',
            'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
