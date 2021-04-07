<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException; 
use App\Semesters;
use App\Classrooms;
use PDF;

class ReportClassRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $semesters = [];
        $semesters_id = Semesters::all()->pluck('semesters_id');
        $data_semesters = Semesters::all()->pluck('semesters');        
        for($i=0; $i < $semesters_id->count(); $i++){
            $semesters[$semesters_id[$i]] = Semesters::term_year($data_semesters[$i]);
        }

        $classrooms = [];
        $classrooms_id = Classrooms::all()->pluck('classrooms_id');
        $data_classrooms = Classrooms::all()->pluck('classrooms');
        $data_classrooms_numbers = Classrooms::all()->pluck('numbers');
        for($i=0; $i < $classrooms_id->count(); $i++){
            $classrooms[$classrooms_id[$i]] = $data_classrooms[$i].' '.$data_classrooms_numbers[$i];
        }

        return view('site.admin.reportClassRoom.index', compact(['semesters','classrooms']))->render();
    }

    public function report(Request $request){
        $semesters_id = $request->semesters;
        $classrooms_id = $request->classrooms;
        $status = $request->status;
        $count_status = count($status);       
         
        $data_bookings = DB::table('bookings AS b')
                ->join('classrooms AS c', 'c.classrooms_id', '=', 'b.classrooms_id')
                ->join('semesters AS s', 's.semesters_id', '=', 'b.semesters_id')
                ->where('b.semesters_id', '=', $semesters_id)
                ->where('b.classrooms_id', '=', $classrooms_id)
                ->where(function ($query) use ($count_status,$status) {
                    for($i=0; $i<$count_status; $i++){
                        if($i==0){
                            $query->where('b.status', $status[$i]);
                        }else{
                            $query->orWhere('b.status', '=', $status[$i]);
                        }
                    }
                })              
                ->orderBy('b.bookings_id', 'DESC')
                ->select('*', 'b.status AS bookingStatus', 'b.seats AS bookingSeats')
                ->get();
        
        if($data_bookings->count()==0){
            return back()->with('Warning', 'ไม่มีข้อมูลรีพอร์ตที่ค้นหา');
        }else{
            return view('site.admin.reportClassRoom.report', compact(['data_bookings','semesters_id','classrooms_id','status']))->render();
        }
    }

    public function pdf(Request $request){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_report_to_html($request->semesters, $request->semesters_id, $request->classrooms, $request->classrooms_id, $request->status));
        // Paper Size
        $pdf->setPaper('A4');
        
        return @$pdf->stream();
    }

    function convert_report_to_html($semesters, $semesters_id, $classrooms, $classrooms_id, $status)
    {
        $semesters = decrypt($semesters);
        $semesters_id = decrypt($semesters_id);
        $classrooms = decrypt($classrooms);
        $classrooms_id = decrypt($classrooms_id);
        $status = decrypt($status);
        $count_status = count($status);

        $data_bookings = DB::table('bookings AS b')
                ->join('classrooms AS c', 'c.classrooms_id', '=', 'b.classrooms_id')
                ->join('semesters AS s', 's.semesters_id', '=', 'b.semesters_id')
                ->where('b.semesters_id', '=', $semesters_id)
                ->where('b.classrooms_id', '=', $classrooms_id)
                ->where(function ($query) use ($count_status,$status) {
                    for($i=0; $i<$count_status; $i++){
                        if($i==0){
                            $query->where('b.status', $status[$i]);
                        }else{
                            $query->orWhere('b.status', '=', $status[$i]);
                        }
                    }
                })              
                ->orderBy('b.bookings_id', 'DESC')
                ->select('*', 'b.status AS bookingStatus', 'b.seats AS bookingSeats')
                ->get();

        return view('site.admin.reportClassRoom.pdf',
            [
                'data_bookings' => $data_bookings,
                'semesters' => $semesters,
                'classrooms' => $classrooms,
            ]
        );
    }

}
