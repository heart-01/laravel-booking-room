<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException; 
use App\Assessment_form;
use App\Semesters;
use App\Classrooms;
use PDF;

class ReportAssessmentController extends Controller
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

        return view('site.admin.reportAssessment.index', compact(['semesters','classrooms']))->render();
    }

    public function report(Request $request){
        $semesters_id = $request->semesters;
        $semesters = Semesters::find($semesters_id);
        $semesters = Semesters::term_year($semesters->semesters);

        $classrooms_id = $request->classrooms;
        $classrooms = Classrooms::find($classrooms_id);        
        $classrooms = $classrooms->classrooms .' '. $classrooms->numbers;        

        $data_assessment = DB::table('assessment AS a')
                ->join('assessment_form AS af', 'af.assessment_form_id', '=', 'a.assessment_form_id')
                ->join('question AS q', 'q.question_id', '=', 'a.question_id')
                ->join('users AS u', 'u.id', '=', 'a.users_id')
                ->where('af.semesters_id', '=', $semesters_id)
                ->where('af.classrooms_id', '=', $classrooms_id)            
                ->orderBy('a.users_id', 'DESC')
                ->orderBy('q.article')
                ->select('*', 'a.created_at AS assCreate')
                ->get();

        if($data_assessment->count()==0){
            return back()->with('Warning', 'ไม่มีข้อมูลรีพอร์ตที่ค้นหา');
        }else{
            return view('site.admin.reportAssessment.report', compact(['semesters', 'semesters_id', 'classrooms', 'classrooms_id', 'data_assessment']))->render();
        }
    }

    public function pdf(Request $request){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_report_to_html($request->semesters, $request->semesters_id, $request->classrooms, $request->classrooms_id));
        // Paper Size
        $pdf->setPaper('A4');
        
        return @$pdf->stream();
    }

    function convert_report_to_html($semesters, $semesters_id, $classrooms, $classrooms_id)
    {
        $semesters = decrypt($semesters);
        $semesters_id = decrypt($semesters_id);
        $classrooms = decrypt($classrooms);
        $classrooms_id = decrypt($classrooms_id);

        $data_assessment = DB::table('assessment AS a')
                ->join('assessment_form AS af', 'af.assessment_form_id', '=', 'a.assessment_form_id')
                ->join('question AS q', 'q.question_id', '=', 'a.question_id')
                ->join('users AS u', 'u.id', '=', 'a.users_id')
                ->where('af.semesters_id', '=', $semesters_id)
                ->where('af.classrooms_id', '=', $classrooms_id)            
                ->orderBy('a.users_id', 'DESC')
                ->select('*', 'a.created_at AS assCreate')
                ->get();

        return view('site.admin.reportAssessment.pdf',
            [
                'data_assessment' => $data_assessment,
                'semesters' => $semesters,
                'classrooms' => $classrooms,
            ]
        );
    }
}
