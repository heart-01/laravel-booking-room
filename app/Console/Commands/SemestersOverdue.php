<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Bookings;
use App\Semesters;
use App\Assessment_form;

class SemestersOverdue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:semestersoverdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Semesters day end Overdue';

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
        $data = DB::table('semesters')->where('semesters_status', '=', '1');
        $count = $data->count();
        if($count==1){ 
            //เช็คว่าวันที่สิ้นภาคเรียนการศึกษาเกินกำหนดไหม
            $semesters_id = $data->first()->semesters_id;
            $semesters_end = $data->first()->semesters_end;
            if($semesters_end < date("Y-m-d")){
                try {
                    //ส่งอีเมลแจ้งเตือนทำแบบประเมินหลังจบภาคเรียน
                    $ck_bookings = Bookings::where('status', '!=', 0)->where('status', '!=', 1)->where('semesters_id', '=', $semesters_id); //ดึงข้อมูลการจองห้องของผู้ใช้ทั้งหมดในปีการศึกษานี้ไม่เอาสถานะ 0 1
                    if($ck_bookings->count() != 0){
                        //ส่งอีเมลให้ผู้ใช้ทั้งหมดในปีการศึกษานี้
                        foreach ($ck_bookings->get() as $row) {
                            $detail = [
                                'fname' => $row->fname,
                                'lname' => $row->lname,
                                'message' => "กรุณาทำแบบประเมินการใช้ห้องเรียนสำนักคอมพิวเตอร์และเทคโนโลยีสารสนเทศด้วยค่ะ.. https://www.youtube.com/",
                            ]; 
                            try{
                                \Mail::to($row->email)->send(new \App\Mail\BookingsMail($detail));
                            }catch(\Swift_TransportException $transportExp){
                                //$transportExp->getMessage();
                                $detail['fname'] = '';
                                $detail['fname'] = '';
                                $detail['message'] = "ส่งอีเมลในการทำแบบประเมินการใช้ห้องเรียนสำนักคอมพิวเตอร์ให้ คุณ $row->fname $row->lname ไม่สำเร็จ <br>Code Error : ".$transportExp->getMessage();
                                \Mail::to('s1104300051612@gmail.com')->send(new \App\Mail\BookingsMail($detail));
                                $this->info('Error Mail');
                            }
                        }
                    }
                    //ปรับสถานะของการจองห้องเรียนในภาคเรียนที่เกินกำหนด
                    DB::beginTransaction();
                    Assessment_form::where('status', '=', 1)->update(['status' => 0]);
                    Assessment_form::where('semesters_id', '=', $semesters_id)->update(['status' => 1]); //เปิดให้มีการประเมินการใช้ห้องของภาคเรียน
                    Bookings::where('semesters_id', '=', $semesters_id)->where('status', '=', 1)->update(['status' => 0]);
                    Bookings::where('semesters_id', '=', $semesters_id)->where('status', '=', 2)->update(['status' => 3]);
                    DB::commit();
                    //ปรับสถานะของภาคเรียนที่เกินกำหนด
                    $Semesters = Semesters::find($semesters_id);
                    $Semesters->semesters_status = 0;
                    $saved = $Semesters->save();
                    if($saved){
                        $this->info('OK semesters');
                    }else{
                        $this->info('Error semesters');
                    }
                }catch (Exception $e) {
                    DB::rollback();
                    $this->info('Error DB');
                }
            }
        }
    }
}
