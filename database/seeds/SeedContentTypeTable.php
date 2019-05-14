<?php

use Illuminate\Database\Seeder;

class SeedContentTypeTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('content_type')->insert([
            'content_type_attribute' => "Album",
            'content_type' => "Music",
            'password' => bcrypt('secret'),
        ]);
    }
}
