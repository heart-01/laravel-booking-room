<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classrooms_Support;

class ClassRoomsSupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    function index(){
        $data = Classrooms_Support::Classrooms_supportAll();
        $count = $data->count();
        $data = $data->paginate(10);
        
        $offset = $data->count();
        $first = ($count==0) ? 0 : 1;
        $end = ($count<10) ? $count : 10;
        return view('site.admin.classrooms_support.classrooms_support', compact(['data','count','first','end']))->render();
    }

    function fetch_data(Request $request){
        if($request->ajax()){
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $data = DB::table('classrooms_support')
                        ->where('classrooms_support_id', 'like', '%'.$query.'%')
                        ->orWhere('classrooms_support', 'like', '%'.$query.'%')
                        ->orderBy($sort_by, $sort_type);
            $count = $data->count();
            $data = $data->paginate(10);
            //info(compact(['data','count']));
            return view('site.admin.classrooms_support.classrooms_support_data-row', compact(['data']))->render();
        }
    }

    function pagination_link(Request $request){
        if($request->ajax()){
            $page = $request->get('page');
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $data = DB::table('classrooms_support')
                        ->where('classrooms_support_id', 'like', '%'.$query.'%')
                        ->orWhere('classrooms_support', 'like', '%'.$query.'%')
                        ->orderBy($sort_by, $sort_type);
            $count = $data->count();
            $data = $data->paginate(10);
            
            $offset = $data->count();
            $first = ($page-1 == 0) ? 1 : $page-1 . 1;
            $end = ($offset!=10) ? ($page-1 == 0) ? $offset : $page-1 . $offset : $page . 0;
            
            return view('site.admin.classrooms_support.classrooms_support_pagination-link', compact(['data','count','first','end']))->render();
        }
    }

    public function store(Request $request){
        $classrooms_support = $request->get('classrooms_support');
        $date_time = date('Y-m-d H:i:s');        

        $data = array('classrooms_support'=>$classrooms_support, "created_at"=>$date_time, "updated_at"=>$date_time,);

        $query = DB::table('classrooms_support')->where('classrooms_support', '=', $classrooms_support);
        $count = $query->count();
        if($count>='1'){
            return back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจากมีข้อมูลของ \''.$classrooms_support.'\' นี้อยู่แล้ว');
        }else{
            $insert = DB::table('classrooms_support')->insert($data);
            
            return ($insert) ? back()->with('Success', 'เพิ่มข้อมูลเรียบร้อย') : back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้ติดต่อผู้ดูแลระบบ');
        }
    }

    public function update(Request $request){
        $classrooms_support_id = $request->get('classrooms_support_id-edit');
        $classrooms_support = $request->get('classrooms_support-edit');         

        $query = DB::table('classrooms_support')->where('classrooms_support', '=', $classrooms_support);
        $count = $query->count();
        if($count>='1'){
            return back()->with('Warning', 'ไม่สามารถแก้ไขข้อมูลได้เนื่องจากมีข้อมูลของ \''.$classrooms_support.'\' นี้อยู่แล้ว');
        }else{
            $Classrooms_Support = Classrooms_Support::find($classrooms_support_id);
            $Classrooms_Support->classrooms_support = $classrooms_support;
            $Classrooms_Support->save(); 
            
            return back()->with('Success', 'แก้ไขข้อมูลเรียบร้อย');
        }      
    }

    public function classrooms_support_del(Request $request){
        if($request->ajax()){
            $classrooms_support_id = $request->get('classrooms_support_id');

            $Classrooms_Support = Classrooms_Support::find($classrooms_support_id);
            $Classrooms_Support->delete();

            return 'del';
        }
    }
}
