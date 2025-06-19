<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Weight_targetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weight_targets')->insert([
            [
                'user_id' => '1',
                'target_weight' => '46.5'
            ]
        ]);
    }
}
