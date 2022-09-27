<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoreySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoreys = ['هندسة مدنية','هندسة كهرباء','هندسة معمار','هندسة طبية','هندسة مكنيكا','هندسة مواد','هندسة برمجيات','هندسة مساحة','هندسة زراعة','امن وسلامة'];

        foreach ($categoreys as $categorey) {
            
            \App\Models\Categorey::create([
                'name' => $categorey,
            ]);

        }//end of each

    }//end of run
    
}//end of class