<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Softwares;

class SortwaresController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    function index(){
        $data = Softwares::SoftwaresAll();
        $count = $data->count();
        $data = $data->paginate(10);
        
        $offset = $data->count();
        $first = ($count==0) ? 0 : 1;
        $end = ($count<10) ? $count : 10;
        return view('site.admin.softwares.softwares', compact(['data','count','first','end']))->render();
    }

    function fetch_data(Request $request){
        if($request->ajax()){
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $data = DB::table('softwares')
                        ->where('softwares_id', 'like', '%'.$query.'%')
                        ->orWhere('softwares', 'like', '%'.$query.'%')
                        ->orderBy($sort_by, $sort_type);
            $count = $data->count();
            $data = $data->paginate(10);
            //info(compact(['data','count']));
            return view('site.admin.softwares.softwares_data-row', compact(['data']))->render();
        }
    }

    function pagination_link(Request $request){
        if($request->ajax()){
            $page = $request->get('page');
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $data = DB::table('softwares')
                        ->where('softwares_id', 'like', '%'.$query.'%')
                        ->orWhere('softwares', 'like', '%'.$query.'%')
                        ->orderBy($sort_by, $sort_type);
            $count = $data->count();
            $data = $data->paginate(10);
            
            $offset = $data->count();
            $first = ($page-1 == 0) ? 1 : $page-1 . 1;
            $end = ($offset!=10) ? ($page-1 == 0) ? $offset : $page-1 . $offset : $page . 0;
            
            return view('site.admin.softwares.softwares_pagination-link', compact(['data','count','first','end']))->render();
        }
    }

    public function store(Request $request){
        $softwares = $request->get('softwares');
        $date_time = date('Y-m-d H:i:s');        

        $data = array('softwares'=>$softwares, "created_at"=>$date_time, "updated_at"=>$date_time,);

        $query = DB::table('softwares')->where('softwares', '=', $softwares);
        $count = $query->count();
        if($count>='1'){
            return back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจากมีข้อมูลของ \''.$softwares.'\' นี้อยู่แล้ว');
        }else{
            $insert = DB::table('softwares')->insert($data);
            
            return ($insert) ? back()->with('Success', 'เพิ่มข้อมูลเรียบร้อย') : back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้ติดต่อผู้ดูแลระบบ');
        }
    }

    public function update(Request $request){
        $softwares_id = $request->get('softwares_id-edit');
        $softwares = $request->get('softwares-edit');         

        $query = DB::table('softwares')->where('softwares', '=', $softwares);
        $count = $query->count();
        if($count>='1'){
            return back()->with('Warning', 'ไม่สามารถแก้ไขข้อมูลได้เนื่องจากมีข้อมูลของ \''.$softwares.'\' นี้อยู่แล้ว');
        }else{
            $Softwares = Softwares::find($softwares_id);
            $Softwares->softwares = $softwares;
            $Softwares->save(); 
            
            return back()->with('Success', 'แก้ไขข้อมูลเรียบร้อย');
        }      
    }

    public function softwares_del(Request $request){
        if($request->ajax()){
            $softwares_id = $request->get('softwares_id');

            $Softwares = Softwares::find($softwares_id);
            $Softwares->delete();

            return 'del';
        }
    }

}
