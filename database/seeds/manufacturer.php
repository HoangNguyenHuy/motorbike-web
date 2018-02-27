<?php

use Illuminate\Database\Seeder;

class manufacturer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mft = ['yamaha', 'honda', 'suzuki', 'sym', 'piaggio', 'unknown'];
        for ($i = 0; $i < sizeof($mft); $i++) {
            DB::table('manufacturers')->insert([

                'name' => $mft[$i],
                'created_at' => new DateTime()

            ]);
        }
    }
}
