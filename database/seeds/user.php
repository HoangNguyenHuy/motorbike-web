<?php

use Illuminate\Database\Seeder;

class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            'name' => 'admin',
            'email' => 'hoangnguyendctit@gmail.com',
            'password' => md5('admin'),

        ]);

    }
}
