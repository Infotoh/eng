<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Consultation::create([
            'number'       => 2222,
            'name'         => 'name Consultation',
            'consultion'   => '22consultion consultion consultion consultion',
            'categorey_id' => 1,
        ]);

    }//end of run

}//end of class