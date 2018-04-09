<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'text' => str_random(50),
            'body' => str_random(250),
           
        ]);
    }
}
