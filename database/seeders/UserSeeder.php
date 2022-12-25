<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = ['علي حسن', 'احمد امين', 'عبدالرحمن', 'عبد الباقي حسن'];

        foreach ($users as $index=>$user) {

            \App\Models\User::create([
                'username'   => $user,
                'phone'      => "0114929636$index",
            ]);

        }//end of for each

    }//en of run

}//end of class
