<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException; 
use App\Events\UserLoggedIn;
use App\Rules\Captcha;
use App\Class_detail_img;
use App\Bookings;
use App\Book_softwares;
use App\Semesters;
use App\Assessment_form;
use App\Assessment;
use PDF;

use Notification;
use App\Profiles;
use App\Notifications\NewNotification;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        event(new  UserLoggedIn("Your login has success"));
        // $data = Semesters::where('semesters_status', '=', '1')
        //     ->where('semesters_start', '>=', date("Y-m-d"))
        //     ->where('semesters_end', '<=', date("Y-m-d"));
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
                        return redirect()->route('home')->with('Error', 'ขออภัย. ยังไม่เปิดให้จองห้องเรียนในขณะนี้');
                    }
                }catch (Exception $e) {
                    DB::rollback();
                    return redirect()->route('home')->with('Error', 'ขออภัย. ยังไม่เปิดให้จองห้องเรียนในขณะนี้');
                }
            }
            // ----------------------------------------------------------------------------------------------
            //เช็คผู้ใช้มีประวัติการจองห้องไหม ถ้ามีต้องทำแบบประเมินก่อน ถ้าทำแล้ว หรือ ไม่มีประวัติการจองห้อง ในปีการศึกษาที่เปิดประเมินก็สามารถจองได้เลย
            $data_assessment_form = Assessment_form::where('status', '=', 1);
            if($data_assessment_form->count() != 0){
                $data_assessment_form = $data_assessment_form->first();
                $semesters_id_assessment_form = $data_assessment_form->semesters_id; //semesters_id แบบฟอร์มที่มีการเปิดประเมิน
                $bookings_classrooms_id = Bookings::where('status', '=', 3)->where('semesters_id', '=', $semesters_id_assessment_form)->where('users_id', '=', Auth::user()->id)->distinct()->pluck('classrooms_id'); //ดึงข้อมูล classrooms_id ของ user ที่มีการ bookings ในปีการศึกษาที่มีการเปิดประเมิน
                if($bookings_classrooms_id->count()!=0){ //ถ้ามีการจองในปีการศึกษาที่เปิดประเมิน
                    $ck_assessment = Assessment_form::with('assessment')->where('assessment_form.status', 1)->whereIn('assessment_form.classrooms_id', $bookings_classrooms_id)->get(); //ดึงข้อมูลแบบประเมินทุกห้องที่มีการจอง
                    $data_assessment = $ck_assessment->pluck('assessment'); //ดึงข้อมูลเฉพาะแบบประเมิน
                    $check = 0;
                    for($i=0; $i<$ck_assessment->count(); $i++){
                        if(!$data_assessment[$i]->isEmpty()){ //เช็คข้อมูลการทำแบบประเมิน ถ้ามีข้อมูลการทำ
                            $check++; //บวกจำนวนที่มีการทำแบบประเมิน
                            // return 'not empty';
                        }
                    }
                    //เปรียบเทียบค่าที่ได้จากการทำแบบประเมิน กับ จำนวนห้องที่มีการจองไว้
                    if($ck_assessment->count()!=$check){
                        return redirect()->route('assessment')->with('Warning', 'กรุณาทำแบบประเมินให้ครบตามจำนวนห้องที่จอง');
                    }
                }
            }
            // ----------------------------------------------------------------------------------------------
            // $semesters_start = date('d/m/Y', strtotime($data->first()->semesters_start));
            // $semesters_end = date('d/m/Y', strtotime($data->first()->semesters_end));
            // $minDate = "$semesters_start 08:00";
            // $maxDate = "$semesters_end 21:00";
            $term = explode("/", $data->first()->semesters);
            $txtHeader = $term[1].'/'.($term[0]+543);
            $semesters = $data->first()->semesters;
            $txt_semesters = "ภาคการศึกษา $term[1]";
            return view('site.front.books.index', compact(['semesters','txt_semesters','semesters_id','txtHeader']))->render();
        }else{
            return redirect()->route('home')->with('Warning', 'ขออภัย. ยังไม่เปิดให้จองห้องเรียนในขณะนี้');
        }
    }

    public function page_data(Request $request){
        $semesters = $request->semester; 
        $days = $request->Droom;  
        $time_start = str_replace('.', ':', $request->TroomS).':00'; 
        $time_end = str_replace('.', ':', $request->TroomE).':00';
        $semesters_id = $request->semesters_id;  
        $seats = (int)$request->seats;
        
        if($request->TroomS >= $request->TroomE){
            return 'time';
        }
        (int)$minute = $request->TroomS - $request->TroomE;
        if($minute > -1){
            return 'minute';
        }

        $validator = Validator::make($request->all(), [
            'reCaptcha' => new Captcha(),
        ]);
        if ($validator->passes()) {
            // success
            $seats_room = DB::table('classrooms AS c')->where('c.seats', '>=', $seats)->count();
            
            if($seats_room == 0){
                return 'seats_room';
            }else{
                //นับรายการที่ไม่อยู่ในรายการจอง
                /* DB::select( 
                    DB::raw("SELECT COUNT(*) AS count
                            FROM classrooms
                            WHERE classrooms_id NOT IN
                            (
                                SELECT b.classrooms_id
                                FROM bookings AS b
                                INNER JOIN classrooms AS c 
                                ON c.classrooms_id = b.classrooms_id
                                WHERE (b.DTstart BETWEEN '$DTroomS' AND '$DTroomE') OR  
                                (b.DTend BETWEEN '$DTroomS' AND '$DTroomE') OR  
                                ('$DTroomS' BETWEEN b.DTstart AND b.DTend) OR 
                                ('$DTroomE' BETWEEN b.DTstart AND b.DTend)
                            ) AND seats >= $seats")
                );
                WHERE (b.time_start BETWEEN '$time_start' AND '$time_end' AND b.semesters_id = '$semesters_id' AND b.days = '$days' AND b.status != '0' AND b.status != '3') OR  
                (b.time_end BETWEEN '$time_start' AND '$time_end' AND b.semesters_id = '$semesters_id' AND b.days = '$days' AND b.status != '0' AND b.status != '3') OR  
                ('$time_start' BETWEEN b.time_start AND b.time_end AND b.semesters_id = '$semesters_id' AND b.days = '$days' AND b.status != '0' AND b.status != '3') OR 
                ('$time_end' BETWEEN b.time_start AND b.time_end AND b.semesters_id = '$semesters_id' AND b.days = '$days' AND b.status != '0' AND b.status != '3') */
                //0= cancel  1= Wait for approval  2= approval  3= End
                $booking_seats_count = DB::select( 
                                            DB::raw("SELECT COUNT(*) AS count
                                                        FROM classrooms
                                                    WHERE classrooms_id NOT IN
                                                    (
                                                        SELECT b.classrooms_id
                                                            FROM bookings AS b
                                                        WHERE (b.time_start > '$time_start' AND b.time_start < '$time_end' AND b.semesters_id = '$semesters_id' AND b.days = '$days' AND b.status != '0' AND b.status != '3') OR  
                                                        (b.time_end > '$time_start' AND b.time_end < '$time_end' AND b.semesters_id = '$semesters_id' AND b.days = '$days' AND b.status != '0' AND b.status != '3') OR  
                                                        ('$time_start' > b.time_start AND '$time_start' < b.time_end AND b.semesters_id = '$semesters_id' AND b.days = '$days' AND b.status != '0' AND b.status != '3') OR 
                                                        ('$time_end' > b.time_start AND '$time_end' < b.time_end AND b.semesters_id = '$semesters_id' AND b.days = '$days' AND b.status != '0' AND b.status != '3')
                                                    ) AND seats >= $seats AND status != '0'")
                                        );
                $collection = collect($booking_seats_count);
                $booking_seats_count = $collection->implode('count', ', ');

                /*DB::table('classrooms')
                ->whereNotIn('classrooms_id',
                    DB::table('bookings AS b')
                    ->join('classrooms AS c', 'c.classrooms_id', '=', 'b.classrooms_id')
                    ->where(function ($query) use ($DTroomS, $DTroomE) {
                        $query->whereBetween('b.DTstart', array($DTroomS, $DTroomE));
                    })
                    ->orWhere(function ($query) use ($DTroomS, $DTroomE) {
                        $query->whereBetween('b.DTend', array($DTroomS, $DTroomE));
                    })
                    ->select('b.classrooms_id')
                )
                ->where('seats', '>=', $seats)
                ->count();*/

                if($booking_seats_count == 0){
                    return 'Full_booking';
                }else{
                    //ข้อมูลรายการที่ไม่อยู่ในรายการจอง
                    $data = DB::select( 
                        DB::raw("SELECT *
                                FROM classrooms cr
                                INNER JOIN class_detail_img dm
                                    ON dm.classrooms_id = cr.classrooms_id
                                WHERE cr.classrooms_id NOT IN
                                (
                                    SELECT b.classrooms_id
                                        FROM bookings AS b
                                    WHERE (b.time_start > '$time_start' AND b.time_start < '$time_end' AND b.semesters_id = '$semesters_id' AND b.days = '$days' AND b.status != '0' AND b.status != '3') OR  
                                    (b.time_end > '$time_start' AND b.time_end < '$time_end' AND b.semesters_id = '$semesters_id' AND b.days = '$days' AND b.status != '0' AND b.status != '3') OR  
                                    ('$time_start' > b.time_start AND '$time_start' < b.time_end AND b.semesters_id = '$semesters_id' AND b.days = '$days' AND b.status != '0' AND b.status != '3') OR 
                                    ('$time_end' > b.time_start AND '$time_end' < b.time_end AND b.semesters_id = '$semesters_id' AND b.days = '$days' AND b.status != '0' AND b.status != '3')
                                ) AND cr.seats >= $seats AND cr.status != '0' AND dm.preview = 1")
                    );
                    return $data; 
                }
            }
        }
        return 'ReCaptcha'; // not success
    }

    public function page_info(Request $request){
        if($request->ajax()){
            $classrooms_id = $request->classrooms_id;
            $sup = DB::table('classrooms_support AS s')
                ->join('class_detail_support AS ds', 'ds.classrooms_support_id', '=', 's.classrooms_support_id')
                ->where('ds.classrooms_id', '=', $classrooms_id)
                ->select('*')->get();
            $sof = DB::table('softwares AS s')
                    ->join('class_detail_softwares AS ds', 'ds.softwares_id', '=', 's.softwares_id')
                    ->where('ds.classrooms_id', '=', $classrooms_id)
                    ->select('*')->get();
            $imgPre = Class_detail_img::where('classrooms_id', '=', $classrooms_id)->where('preview', '=', 1)->first();
            $img = Class_detail_img::where('classrooms_id', '=', $classrooms_id)->orderBy("preview", "desc")->get();

            return $data = array(
                    'sup' => array($sup),
                    'sof' => array($sof),
                    'imgPre' => array($imgPre),
                    'img' => array($img),
                    'Encrypt_classID' => Crypt::encrypt($classrooms_id),
            );
        }
    }

    public function page_confirm(Request $request){
        if($request->ajax()){
            $Bookings = new Bookings;
            $Bookings->users_id = Auth::user()->id;
            $Bookings->classrooms_id = decrypt($request->classID);
            $Bookings->semesters_id = $request->semesters_id;
            $Bookings->days = $request->days;
            $Bookings->time_start = str_replace('.', ':', $request->time_start).':00';
            $Bookings->time_end = str_replace('.', ':', $request->time_end).':00';
            $Bookings->seats = $request->seat;
            $Bookings->status = '1';
            $Bookings->fname = $request->fname;
            $Bookings->lname = $request->lname;
            $Bookings->email = $request->email;
            $Bookings->tel = $request->tel;
            $Bookings->faculty = $request->faculty;
            $Bookings->subject = $request->subject;
            $Bookings->course_code = $request->course_code;
            $Bookings->part = $request->part;
            $saved = $Bookings->save();
            if($saved){
                $BookingsLastId = $Bookings->bookings_id;
                //Other Sofware
                if($request->otherSofware){
                    $Book_softwares = new Book_softwares;
                    $Book_softwares->bookings_id = $BookingsLastId;
                    $Book_softwares->otherSofware = $request->otherSofware;
                    $Book_softwares->save();
                }
                //Sel Sofware
                for($i=0; $i < count($request->selSoftwares); $i++){
                    $data = array(
                        'bookings_id' => $BookingsLastId,
                        'softwares_id' => $request->selSoftwares[$i]
                    );            
                    $insertData[] = $data;
                }            
                $save = Book_softwares::insert($insertData);

                if($save){
                    $user = Profiles::where('status_id', 2)->get(); //user ที่จะส่งการแจ้งเตือนให้
                    $details = [    //รายละเอียด
                        'color' => 'success',
                        'title' => 'จอง '.$request->classroomsName,
                        'body' => 'คุณ '.$request->fname.' '.$request->lname.' จอง '.$request->classroomsName,
                    ];
                    Notification::send($user, new NewNotification($details)); //ส่งการแจ้งเตือน

                    $detail = [
                        'fname' => $request->fname,
                        'lname' => $request->lname,
                        'message' => "ได้จองห้องเรียนผ่านระบบออนไลน์ โปรดตรวจสอบและอนุมัติ https://www.youtube.com/",
                    ];        
                    \Mail::to('s1104300051612@gmail.com')->send(new \App\Mail\BookingsMail($detail));
    
                    return $data = array(
                        'data' => $request->all(),
                        'bookingsId' => Crypt::encrypt($BookingsLastId),
                    );
                }
            }else{
                App::abort(500, 'Error');
            }
        }
    }

    public function update(Request $request){
        if($request->ajax()){
            $BookingsId = decrypt($request->classID);
            $Bookings = Bookings::find($BookingsId);
            $Bookings->fname = $request->fname;
            $Bookings->lname = $request->lname;
            $Bookings->email = $request->email;
            $Bookings->tel = $request->tel;
            $Bookings->faculty = $request->faculty;
            $Bookings->subject = $request->subject;
            $Bookings->course_code = $request->course_code;
            $Bookings->part = $request->part;
            $saved = $Bookings->save();
            if($saved){
                $Book_softwares = Book_softwares::where('bookings_id',$BookingsId);
                $del = $Book_softwares->delete();
                if($del){
                    //Other Sofware
                    if($request->otherSofware){
                        $Book_softwares = new Book_softwares;
                        $Book_softwares->bookings_id = $BookingsId;
                        $Book_softwares->otherSofware = $request->otherSofware;
                        $Book_softwares->save();
                    }
                    //Sel Sofware
                    for($i=0; $i < count($request->selSoftwares); $i++){
                        $data = array(
                            'bookings_id' => $BookingsId,
                            'softwares_id' => $request->selSoftwares[$i]
                        );            
                        $insertData[] = $data;
                    }            
                    $save = Book_softwares::insert($insertData);

                    if($save){
                        $user = Profiles::where('status_id', 2)->get(); //user ที่จะส่งการแจ้งเตือนให้
                        $details = [    //รายละเอียด
                            'color' => 'warning',
                            'title' => 'แก้ไขข้อมูลการจอง '.$request->classrooms,
                            'body' => 'คุณ '.$request->fname.' '.$request->lname.' ได้แก้ไขข้อมูลการจอง '.$request->classrooms,
                        ];
                        Notification::send($user, new NewNotification($details)); //ส่งการแจ้งเตือน

                        $detail = [
                            'fname' => $request->fname,
                            'lname' => $request->lname,
                            'message' => "ได้แก้ไขข้อมูลการจอง ".$request->classrooms,
                        ];        
                        \Mail::to('s1104300051612@gmail.com')->send(new \App\Mail\BookingsMail($detail));
        
                        return 'Success';
                    }
                }
            }else{
                App::abort(500, 'Error');
            }
        }
    }

    public function cancel(Request $request){
        if($request->ajax()){
            $BookingsId = decrypt($request->BookingsId);
            $Bookings = Bookings::find($BookingsId);
            $Bookings->status = '0';
            $saved = $Bookings->save();

            if($saved){
                $data = Bookings::with('book_softwares')->with('classrooms')->find($BookingsId);
                $classrooms = $data->classrooms->classrooms;
                $numbers = $data->classrooms->numbers;
                $nameClass = $classrooms.' '.$numbers;

                $user = Profiles::where('status_id', 2)->get(); //user ที่จะส่งการแจ้งเตือนให้
                $details = [    //รายละเอียด
                    'color' => 'danger',
                    'title' => 'ยกเลิกการจอง '.$nameClass,
                    'body' => 'คุณ '.$data->fname.' '.$data->lname.' ได้ยกเลิกการจอง '.$nameClass,
                ];
                Notification::send($user, new NewNotification($details)); //ส่งการแจ้งเตือน
    
                $detail = [
                    'fname' => $data->fname,
                    'lname' => $data->lname,
                    'message' => "ได้ยกเลิกการจอง ".$nameClass,
                ];        
                \Mail::to('s1104300051612@gmail.com')->send(new \App\Mail\BookingsMail($detail));
                
                return 'success';  
            }else{
                return 'unsuccess' ;
            }            
        }
    }

    public function pdf(Request $request){
        $BookingsId = decrypt($request->BookingsId);
        $data = Bookings::with('classrooms')->find($BookingsId);
        $classrooms = $data->classrooms->classrooms;
        $numbers = $data->classrooms->numbers;
        $nameClass = $classrooms.' '.$numbers;

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_report_to_html($data,$nameClass));
        // Paper Size
        $pdf->setPaper('A4');
        
        return @$pdf->stream();
    }

    function convert_report_to_html($data,$nameClass)
    {
        return view('site.front.books.permitPDF',
            [
                'data' => $data,
                'nameClass' => $nameClass,
            ]
        );
    }
}
