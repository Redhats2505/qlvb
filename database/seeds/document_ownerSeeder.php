<?php

use Illuminate\Database\Seeder;

class document_ownerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_owner')->insert([
            'name' => 'Valenciano',
            'descriptions' => 'Công ty Valenciano',
            'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('document_owner')->insert([
            'name' => 'CP DTTM BTP',
           'descriptions' => 'Công ty cổ phần đầu tư thương mại Bách Tường Phát',
            'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('document_owner')->insert([
            'name' => 'Tập đoàn BTP',
            'descriptions' => 'Công ty cổ phần tập đoàn Bách Tường Phát',
            'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
