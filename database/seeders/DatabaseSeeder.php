<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(CategoreySeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(ConsultationSeeder::class);
        $this->call(TrainingSeeder::class);
        $this->call(UserSeeder::class);

    }//end of run

}//end of class