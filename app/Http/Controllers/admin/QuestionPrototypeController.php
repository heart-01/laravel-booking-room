<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException; 
use Illuminate\Support\Facades\DB;
use App\Assessment_form;
use App\QuestionPrototype;
use App\Question;
use App\Semesters;
use App\Classrooms;

class QuestionPrototypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    function index(){
        $data_semesters = Semesters::where('semesters_status', '=', 1)->first();
        if(!$data_semesters){
            return back()->with('Warning', 'ไม่พบข้อมูลภาคการศึกษาปัจจุบัน');
        }
        $semesters = $data_semesters->semesters;  
        $semesters_id = $data_semesters->semesters_id;   
        $data = QuestionPrototype::orderBy('article', 'asc')->get();     
        return view('site.admin.questionPrototype.index', compact(['semesters_id', 'semesters', 'data']))->render();
    }

    public function store(Request $request){
        $article = $request->get('article');
        $question = $request->get('question');
        $date_time = date('Y-m-d H:i:s');        
        $data = array('article'=>$article, 'question'=>$question, "created_at"=>$date_time, "updated_at"=>$date_time,);

        $ck_article = DB::table('question_prototype')->where('article', '=', $article)->count();

        if($ck_article>=1){
            return back()->with('Warning', "ไม่สามารถเพิ่มข้อมูลได้<br>เลขข้อแบบสอบถาม $article มีอยู่แล้ว");
        }else{
            $insert = DB::table('question_prototype')->insert($data);
            return ($insert) ? back()->with('Success', 'เพิ่มข้อมูลเรียบร้อย') : back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้ติดต่อผู้ดูแลระบบ');
        }
    }

    public function update(Request $request){
        $question_prototype_id = $request->get('question_prototype_id-edit');
        $article = $request->get('article-edit');  
        $question = $request->get('question-edit');  
        
        $data_question_prototype_old = QuestionPrototype::where('question_prototype_id', $question_prototype_id)->first();
        $article_old = $data_question_prototype_old->article;
        if($article_old==$article)
        {
            $QuestionPrototype = QuestionPrototype::find($question_prototype_id);
            $QuestionPrototype->question = $question;
            $QuestionPrototype->save(); 
            return back()->with('Success', 'แก้ไขข้อมูลเรียบร้อย'); 
        }else{
            $ck_article = DB::table('question_prototype')->where('article', '=', $article)->count();
            if($ck_article>=1){
                return back()->with('Warning', "ไม่สามารถเพิ่มข้อมูลได้<br>เลขข้อแบบสอบถาม $article มีอยู่แล้ว");
            }else{
                $QuestionPrototype = QuestionPrototype::find($question_prototype_id);
                $QuestionPrototype->article = $article;
                $QuestionPrototype->question = $question;
                $QuestionPrototype->save(); 
                return back()->with('Success', 'แก้ไขข้อมูลเรียบร้อย'); 
            }  
        }
    }

    public function del(Request $request){
        if($request->ajax()){
            $question_prototype_id = $request->get('question_prototype_id');

            $QuestionPrototype = QuestionPrototype::find($question_prototype_id);
            $QuestionPrototype->delete();

            return 'del';
        }
    }

    public function setQuestion(Request $request){
        $semesters_id = decrypt($request->get('semesters_id'));
        //ลบแบบฟอร์มประเมินเดิม, รายการคำถามเดิม
        $Assessment_form = Assessment_form::where('semesters_id', $semesters_id);
        $del = $Assessment_form->delete();

        if($del){
            //เพิ่มข้อมูลแบบฟอร์มประเมิน, รายการคำถาม
            $data_classrooms = Classrooms::all();
            $date_time = date('Y-m-d H:i:s');
            foreach ($data_classrooms as $row) {
                $assessment_form_idLast = DB::table('assessment_form')->insertGetId(array('semesters_id'=>$semesters_id, 'classrooms_id'=>$row->classrooms_id, "created_at"=>$date_time, "updated_at"=>$date_time,));
                $data = array();
                for($i=0; $i <= decrypt($request->loopLast); $i++){
                    $data[] = [
                        'assessment_form_id' => $assessment_form_idLast,
                        'question' => decrypt($request->question[$i]),
                        'article' => decrypt($request->article[$i]),                        
                        'created_at' => $date_time,
                        'updated_at' => $date_time,
                    ];
                }
                $saved = Question::insert($data);
            }
            return ($saved) ? 'success' : 'not success' ;
        }
    }

}
