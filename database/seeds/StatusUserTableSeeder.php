<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatusUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();

        $data = [
            [
                'status_id' => 1,
                'status' => 'user',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ],
            [
                'status_id' => 2,
                'status' => 'admin',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]
        ];

        DB::table('status_user')->insert($data);
    }
}
