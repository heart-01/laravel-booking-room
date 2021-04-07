<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException; 
use Illuminate\Support\Facades\DB;
use App\Question;
use App\Assessment_form;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($semesters_id,$classrooms_id)
    {
        if($semesters_id && $classrooms_id){
            $semesters_id   = decrypt($semesters_id);
            $classrooms_id   = decrypt($classrooms_id);

            $data_assessment_form = Assessment_form::where('semesters_id', $semesters_id)->where('classrooms_id', $classrooms_id)->first();
            $assessment_form_id = $data_assessment_form->assessment_form_id;

            $data = Question::where('assessment_form_id', $assessment_form_id)->orderBy('article', 'asc')->get();
            return view('site.admin.question.index', compact(['data', 'assessment_form_id', 'semesters_id', 'classrooms_id']))->render();
        }        
    }
    
    public function store(Request $request){
        $assessment_form_id = $request->get('assessment_form_id');
        $article = $request->get('article');
        $question = $request->get('question');
        $date_time = date('Y-m-d H:i:s');        
        $data = array('assessment_form_id'=>$assessment_form_id, 'article'=>$article, 'question'=>$question, "created_at"=>$date_time, "updated_at"=>$date_time,);

        $ck_article = DB::table('question')->where('article', '=', $article)->where('assessment_form_id', '=', $assessment_form_id);
        $count = $ck_article->count();

        if($count>=1){
            return back()->with('Warning', "ไม่สามารถเพิ่มข้อมูลได้<br>เลขข้อแบบสอบถาม $article มีอยู่แล้ว");
        }else{
            $insert = DB::table('question')->insert($data);
            return ($insert) ? back()->with('Success', 'เพิ่มข้อมูลเรียบร้อย') : back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้ติดต่อผู้ดูแลระบบ');
        }
    }

    public function update(Request $request){
        $assessment_form_id = $request->get('assessment_form_id');
        $question_id = $request->get('question_id-edit');
        $article = $request->get('article-edit');  
        $question = $request->get('question-edit');  
        
        $data_question_old = Question::where('question_id', $question_id)->first();
        $article_old = $data_question_old->article;
        if($article_old==$article)
        {
            $Question = Question::find($question_id);
            $Question->question = $question;
            $Question->save(); 
            return back()->with('Success', 'แก้ไขข้อมูลเรียบร้อย'); 
        }else{
            $ck_article = DB::table('question')->where('article', '=', $article)->where('assessment_form_id', '=', $assessment_form_id);
            $count = $ck_article->count();
            if($count>=1){
                return back()->with('Warning', "ไม่สามารถเพิ่มข้อมูลได้<br>เลขข้อแบบสอบถาม $article มีอยู่แล้ว");
            }else{
                $Question = Question::find($question_id);
                $Question->article = $article;
                $Question->question = $question;
                $Question->save(); 
                return back()->with('Success', 'แก้ไขข้อมูลเรียบร้อย'); 
            }  
        }
    }

    public function del(Request $request){
        if($request->ajax()){
            $question_id = $request->get('question_id');

            $Question = Question::find($question_id);
            $Question->delete();

            return 'del';
        }
    }
}
