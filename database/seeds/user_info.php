<?php

use Illuminate\Database\Seeder;

class user_info extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_profiles')->insert([
            'name' => 'admin',
            'email' => 'hoangnguyendctit@gmail.com',
            'user_id' => 1,
            'phone_number' => '01646909084',
        ]);
    }
}
