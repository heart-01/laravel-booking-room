<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'id' => 1,
            'status_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
