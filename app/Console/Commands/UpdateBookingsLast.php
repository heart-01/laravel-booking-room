<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Bookings;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateBookingsLast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:updatebookingslast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Bookings Last 15 Day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data_semesters = DB::table('semesters')->where('semesters_status', '=', '1');
        if($data_semesters->count()==1){
            $semesters_id = $data_semesters->first()->semesters_id;
            $saved = Bookings::whereDate('created_at', Carbon::now()->subDays(15))->where('semesters_id', '=', $semesters_id)->where('status', '=', 1)->update(['status' => 0]);
            if($saved){
                $this->info('update'); //มีข้อมูลอัปเดต
            }else{
                $this->info('notUpdate'); //ไม่มีข้อมูลอัปเดต
            }           
        }
    }
}
