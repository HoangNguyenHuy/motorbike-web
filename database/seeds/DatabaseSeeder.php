<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(user::class);
        $this->call(manufacturer::class);
        $this->call(user_info::class);
    }
}
