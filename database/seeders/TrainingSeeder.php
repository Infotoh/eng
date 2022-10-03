<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Training::create([
            'number'        => 21111222,
            'number2'       => 9999,
            'name'          => 'training',
            'age'           => 12,
            'gender_type'   => 'mail',
            'qualification' => 'qualification',
            'categorey_id'  => 1,
            'user_id'       => 1,
        ]);

    }//end of run

}//end of class
