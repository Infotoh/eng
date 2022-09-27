<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\Admin::create([
            'name'     => 'admin',
            'email'    => 'super_admin@app.com',
            'password' => bcrypt('123123123'),
        ]);

        $admin->attachRole('super_admin');

        $admin1 = \App\Models\Admin::create([
            'name'     => 'admin1',
            'email'    => 'admin1@app.com',
            'password' => bcrypt('123123123'),
        ]);

        $admin1->attachRole('admin');

        $admin2 = \App\Models\Admin::create([
            'name'     => 'admin2',
            'email'    => 'admin2@app.com',
            'password' => bcrypt('123123123'),
        ]);

        $admin2->attachRole('admin');

    }//end of run
    
}//end of class