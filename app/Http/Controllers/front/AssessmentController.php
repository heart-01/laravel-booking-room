<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException; 
use App\Events\UserLoggedIn;
use App\Assessment_form;
use App\Bookings;
use App\Semesters;
use App\Question;
use App\Assessment;

class AssessmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        event(new  UserLoggedIn("Your login has success"));
        $data = Assessment_form::where('status', '=', 1);
      
        if($data->count() != 0){
            $data_assessment_form = $data->first();
            $semesters_id = $data_assessment_form->semesters_id; //semesters_id แบบฟอร์มที่มีการเปิดประเมิน
            $bookings_classrooms_id = Bookings::where('status', '=', 3)->where('semesters_id', '=', $semesters_id)->where('users_id', '=', Auth::user()->id)->distinct()->pluck('classrooms_id'); //ดึงข้อมูล classrooms_id ของ user ที่มีการ bookings ในปีการศึกษาที่มีการเปิดประเมิน
            if($bookings_classrooms_id->count()!=0){
                //$data_assessment_form = Assessment_form::with('question')->where('status', '=', 1)->whereIn('classrooms_id', $bookings_classrooms_id)->get();
                $data_Assessment_form = Assessment_form::with('classrooms')->with('semesters')->where('status', '=', 1)->whereIn('assessment_form.classrooms_id', $bookings_classrooms_id)->get(); //ดึงข้อมูลแบบฟอร์มที่มีการเปิดประเมิน ที่ classrooms_id ของ user ที่มีการ bookings
                $data_semesters = $data_Assessment_form->pluck('semesters')->pluck('semesters'); $semesters = $data_semesters['0'];

                return view('site.front.assessment.index', compact(['data_Assessment_form','semesters']))->render();
            }else{
                return redirect()->route('home')->with('Warning', 'ไม่มีประวัติการจองห้องเรียน');
            }
        }else{
            return redirect()->route('home')->with('Warning', 'ขออภัย. ยังไม่เปิดให้ประเมินห้องเรียนในขณะนี้');
        }
    }

    public function question($assessment_form_id,$classrooms,$numbers){
        $assessment_form_id = decrypt($assessment_form_id);
        $duplicate = Assessment::where('assessment_form_id', $assessment_form_id)->where('users_id', '=', Auth::user()->id)->count();
        if($duplicate!=0){
            return back()->with('Warning', 'ท่านได้ทำแบบประเมินนี้ไปแล้ว');
        }else{
            $data_question = Question::where('assessment_form_id', $assessment_form_id)->orderBy('article', 'asc')->get();

            return view('site.front.assessment.question', compact(['data_question','classrooms','numbers','assessment_form_id']))->render();
        }        
    }

    public function assessment(Request $request){
        if($request->ajax()){
            for($i=0; $i <= decrypt($request->loopLast); $i++){
                $score = 'req'.$i;
                $data[] = [
                    'users_id' => Auth::user()->id,
                    'assessment_form_id' => decrypt($request->assessment_form_id),
                    'question_id' => decrypt($request->question_id[$i]),
                    'score' => $request->$score,
                    'suggestion' => $request->suggestion,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            $saved = Assessment::insert($data);
            return ($saved) ? 'success' : 'not' ;
        }
    }
}
