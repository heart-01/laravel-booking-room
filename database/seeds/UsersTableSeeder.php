<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'id' => 1,
                'name' => 'Siwat Jomewatthana',
                'email' => 'coolice_55@hotmail.com',
                'password' => Hash::make('77749000'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
        DB::table('users')->insert(
            [
                'id' => 2,
                'name' => 'Siwat Jomewatthana',
                'email' => 's1104300051612@gmail.com',
                'password' => Hash::make('77749000'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        );
    }
}
