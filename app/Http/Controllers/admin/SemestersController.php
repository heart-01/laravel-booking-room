<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Semesters;
use App\Assessment_form;
use App\Question;
use App\Classrooms;
use Illuminate\Support\Facades\Http;

class SemestersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function changeDate($date){
        $d = substr($date,0,2);
        $m = substr($date,3,2);
        $y = substr($date,6,4);
        $n_date = $d.'-'.$m.'-'.$y;
        $dt = strtotime("-543 year", strtotime($n_date));
        $new_dated = date("Y-m-d",$dt);

        return $new_dated;
    }

    function index(){
        $data = Semesters::SemestersAll();
        $count = $data->count();
        $data = $data->paginate(10);
        
        $offset = $data->count();
        $first = ($count==0) ? 0 : 1;
        $end = ($count<10) ? $count : 10;
        return view('site.admin.semesters.semesters', compact(['data','count','first','end']))->render();
    }

    function fetch_data(Request $request){
        if($request->ajax()){
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query')-543;
            $query = str_replace(" ", "%", ($query=='-543') ? $query="" : $query );
            $data = DB::table('semesters')
                        ->where('semesters_id', 'like', '%'.$query.'%')
                        ->orWhere('semesters', 'like', '%'.$query.'%')
                        ->orWhere('semesters_start', 'like', '%'.$query.'%')
                        ->orWhere('semesters_end', 'like', '%'.$query.'%')
                        ->orderBy($sort_by, $sort_type);
            $count = $data->count();
            $data = $data->paginate(10);
            //info(compact(['data','count']));
            return view('site.admin.semesters.semesters_data-row', compact(['data']))->render();
        }
    }

    function pagination_link(Request $request){
        if($request->ajax()){
            $page = $request->get('page');
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query')-543;
            $query = str_replace(" ", "%", ($query=='-543') ? $query="" : $query);
            $data = DB::table('semesters')
                        ->where('semesters_id', 'like', '%'.$query.'%')
                        ->orWhere('semesters', 'like', '%'.$query.'%')
                        ->orWhere('semesters_start', 'like', '%'.$query.'%')
                        ->orWhere('semesters_end', 'like', '%'.$query.'%')
                        ->orderBy($sort_by, $sort_type);
            $count = $data->count();
            $data = $data->paginate(10);
            
            $offset = $data->count();
            $first = ($page-1 == 0) ? 1 : $page-1 . 1;
            $end = ($offset!=10) ? ($page-1 == 0) ? $offset : $page-1 . $offset : $page . 0;
            
            return view('site.admin.semesters.semesters_pagination-link', compact(['data','count','first','end']))->render();
        }
    }

    public function store(Request $request){
        $term = $request->get('term');
        $year = $request->get('year');
        $semesters = $year."/".$term;
        $semesters_start = $this->changeDate($request->semesters_start);
        $semesters_end = $this->changeDate($request->semesters_end);
        $date_time = date('Y-m-d H:i:s');        

        if($semesters_start >= $semesters_end){
            return back()->with('Warning', 'กรอกข้อมูล วันเริ่มภาคเรียน<br>วันสิ้นสุดภาคเรียน ไม่ถูกต้อง.'); 
        }

        $data = array('semesters'=>$semesters, "semesters_start"=>$semesters_start, "semesters_end"=>$semesters_end, "semesters_status"=>'0', "created_at"=>$date_time, "updated_at"=>$date_time,);

        $query = DB::table('semesters')->where('semesters', '=', $semesters);
        $count = $query->count();
        if($count>='1'){
            return back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจากมีข้อมูลของ \''.($year+543)."/".$term.'\' นี้อยู่แล้ว');
        }else{
            $saved = $semesters_idLast = DB::table('semesters')->insertGetId($data);
            if($semesters_idLast){
                //เพิ่มข้อมูลแบบฟอร์มประเมิน, รายการคำถาม
                $data_classrooms = Classrooms::all();
                foreach ($data_classrooms as $row) {
                    $assessment_form_idLast = DB::table('assessment_form')->insertGetId(array('semesters_id'=>$semesters_idLast, 'classrooms_id'=>$row->classrooms_id, "created_at"=>$date_time, "updated_at"=>$date_time,));
                    $saved = Question::insert([ 
                        ['assessment_form_id' => $assessment_form_idLast, 'article' => '1', 'question' => 'จำนวนเครื่องคอมพิวเตอร์และอุปกรณ์ที่ให้บริการเพียงพอ', "created_at"=>$date_time, "updated_at"=>$date_time,],
                        ['assessment_form_id' => $assessment_form_idLast, 'article' => '2', 'question' => 'ประสิทธิภาพของเครื่องคอมพิวเตอร์', "created_at"=>$date_time, "updated_at"=>$date_time,],
                        ['assessment_form_id' => $assessment_form_idLast, 'article' => '3', 'question' => 'โปรแกรมคอมพิวเตอร์ที่ให้บริการตรงต่อความต้องการ', "created_at"=>$date_time, "updated_at"=>$date_time,],
                        ['assessment_form_id' => $assessment_form_idLast, 'article' => '4', 'question' => 'สถานที่และบรรยากาศในการให้บริการ', "created_at"=>$date_time, "updated_at"=>$date_time,],
                        ['assessment_form_id' => $assessment_form_idLast, 'article' => '5', 'question' => 'ความสุภาพและการให้บริการของเจ้าหน้าที่', "created_at"=>$date_time, "updated_at"=>$date_time,],
                        ['assessment_form_id' => $assessment_form_idLast, 'article' => '6', 'question' => 'ขั้นตอนการให้บริการ', "created_at"=>$date_time, "updated_at"=>$date_time,],
                        ['assessment_form_id' => $assessment_form_idLast, 'article' => '7', 'question' => 'การประชาสัมพันธ์การให้บริการของสำนักคอมพิวเตอร์ฯ', "created_at"=>$date_time, "updated_at"=>$date_time,],
                    ]);
                }
                return ($saved) ? back()->with('Success', 'เพิ่มข้อมูลเรียบร้อย') : back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้ติดต่อผู้ดูแลระบบ');
            }
        }
    }

    public function update(Request $request){
        $semesters_id = $request->get('semesters_id-edit');
        $term = $request->get('term-edit');
        $year = $request->get('year-edit');
        $semesters = $year."/".$term;
        $semesters_start_edit = $this->changeDate($request->semesters_start_edit);
        $semesters_end_edit = $this->changeDate($request->semesters_end_edit);
        $date_time = date('Y-m-d H:i:s');

        if($semesters_start_edit >= $semesters_end_edit){
            return back()->with('Warning', 'กรอกข้อมูล วันเริ่มภาคเรียน<br>วันสิ้นสุดภาคเรียน ไม่ถูกต้อง.'); 
        }

        $semesters_old = Semesters::where('semesters_id', $semesters_id)->get(['semesters',]);
        $collection = collect($semesters_old);
        $semesters_old = $collection->implode('semesters', ', ');

        if((string)$semesters_old==$semesters)
        {
            // return 'old semesters';
            $Semesters = Semesters::find($semesters_id);
            $Semesters->semesters_start = $semesters_start_edit;
            $Semesters->semesters_end = $semesters_end_edit;
            $Semesters->save(); 

            return back()->with('Success', 'แก้ไขข้อมูลเรียบร้อย');

        }else if((string)$semesters_old!=$semesters)
        {
            // return 'new semesters';
            $query = DB::table('semesters')->where('semesters', '=', $semesters);
            $count = $query->count();

            if($count=='0'){
                $Semesters = Semesters::find($semesters_id);
                $Semesters->semesters = $semesters;
                $Semesters->semesters_start = $semesters_start_edit;
                $Semesters->semesters_end = $semesters_end_edit;
                $Semesters->save();      
                
                return back()->with('Success', 'แก้ไขข้อมูลเรียบร้อย');
            }else{
                return back()->with('Warning', 'ไม่สามารถแก้ไขข้อมูลได้เนื่องจากมีข้อมูลของ \''.($year+543)."/".$term.'\' นี้อยู่แล้ว');
            }       
        }      
    }

    public function semesters_del(Request $request){
        if($request->ajax()){
            $semesters_id = $request->get('semesters_id');

            $Semesters = Semesters::find($semesters_id);
            $Semesters->delete();

            return 'del';
        }
    }

    public function semesters_status(Request $request){
        if($request->ajax()){
            $semesters_id = $request->get('semesters_id');

            $Semesters = Semesters::where('semesters_status', '1')->update(['semesters_status' => '0']);

            $Semesters = Semesters::find($semesters_id);
            $semesters_status = $request->get('semesters_status');
            $Semesters->semesters_status = ($semesters_status==1) ? 0 : 1 ;
            $Semesters->save();

            return 'change';
        }
    }

    function testAPI(){
        #connect API
        // $response = Http::retry(3, 100)->get('https://randomfox.ca/floof/');
        // $response = Http::retry(3, 100)->get('http://shibe.online/api/shibes?',['count'=>'5']);
        #connect API Auth
        /*
        $url = 'https://api.petfinder.com/v2/animals?type=dog&page=2';
        $apiKey = 'kfVCjdEuoaE4AufPdxi89EcVzWBgdR0hBRTc22JSAxL1cPtirU';
        $secret = 'DFa3lzdHiXua15LlnJiP2sylNRCNMzTl1dMOceU6';
        $response = Http::withHeaders([
            'Authorization' => "DFa3lzdHiXua15LlnJiP2sylNRCNMzTl1dMOceU6",
        ])->get($url)->json();
        // $response = $response = Http::withToken($apiKey)->get($url);
        */
        
        #Error Handling
        // $ck_api = $response->successful(); //Determine if the status code was >= 200 and < 300...
        // $err1 = $response->failed(); //Determine if the status code was >= 400...
        // $err2 = $response->clientError(); //Determine if the response has a 400 level status code...
        // $err3 = $response->serverError(); //Determine if the response has a 500 level status code...

        // if($ck_api){
            /*
            $result = $response->json(); //ดึงข้อมูล API มาทั้งหมด
            $collection= collect($result)->only('image');  //เลือกชุดข้อมูลจาก array มาใส่ใน collection กรองข้อมูลแค่ image
            $array = $collection->toArray(); //แปลงข้อมูล collection ให้มาอยู่ในรูปแบบ array
            */
            //---------------------------------------------------------------------------------------//
            /*
            $result = $response->json(); //ดึงข้อมูล API มาทั้งหมด
            $i = 0;
            foreach($result as $key => $value) {
                // print_r($key);

                // $data[] = $result['value']; //ดึงค่าจาก api มาใส่ในตัวแปร

                if ($i==1) { $data[] = $result['image']; break; } //ดึงค่าจาก api แค่ image ตัวที่ 1
                $i++;
            }
            */
        // }     
        // dd($response);
    }

}
