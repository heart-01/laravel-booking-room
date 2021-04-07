<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classrooms;
use App\Classrooms_Support;
use App\Softwares;
use App\Class_detail_img;
use App\Class_detail_softwares;
use App\Class_detail_support;
use Image; 
use File;
use Illuminate\Support\Str;

class ClassRoomsController extends Controller
{
    function index(){
        $data = Classrooms::ClassroomsAll();
        $count = $data->count();
        $data = $data->paginate(10);
        
        $offset = $data->count();
        $first = ($count==0) ? 0 : 1;
        $end = ($count<10) ? $count : 10;
        return view('site.admin.classrooms.classrooms', compact(['data','count','first','end']))->render();
    }

    function fetch_data(Request $request){
        if($request->ajax()){
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $data = DB::table('classrooms')
                        ->where('classrooms_id', 'like', '%'.$query.'%')
                        ->orWhere('classrooms', 'like', '%'.$query.'%')
                        ->orWhere('numbers', 'like', '%'.$query.'%')
                        ->orderBy($sort_by, $sort_type);
            $count = $data->count();
            $data = $data->paginate(10);
            // info(compact(['data','count']));
            return view('site.admin.classrooms.classrooms_data-row', compact(['data']))->render();
        }
    }

    function pagination_link(Request $request){
        if($request->ajax()){
            $page = $request->get('page');
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $data = DB::table('classrooms')
                        ->where('classrooms_id', 'like', '%'.$query.'%')
                        ->orWhere('classrooms', 'like', '%'.$query.'%')
                        ->orWhere('numbers', 'like', '%'.$query.'%')
                        ->orderBy($sort_by, $sort_type);
            $count = $data->count();
            $data = $data->paginate(10);
            
            $offset = $data->count();
            $first = ($page-1 == 0) ? 1 : $page-1 . 1;
            $end = ($offset!=10) ? ($page-1 == 0) ? $offset : $page-1 . $offset : $page . 0;
            
            return view('site.admin.classrooms.classrooms_pagination-link', compact(['data','count','first','end']))->render();
        }
    }

    public function store(Request $request){
        $classrooms = $request->get('classrooms');
        $numbers = $request->get('numbers');
        $seats = $request->get('seats');
        $prohibitDS = ($request->get('prohibitDS') != 0) ? $request->get('prohibitDS') : 'NULL';
        $prohibitTS = ($request->get('prohibitTS') != 0) ? $request->get('prohibitTS') : 'NULL';
        $prohibitDE = ($request->get('prohibitDE') != 0) ? $request->get('prohibitDE') : 'NULL';
        $prohibitTE = ($request->get('prohibitTE') != 0) ? $request->get('prohibitTE') : 'NULL';
        $prohibit_Start = $prohibitDS.'#'.$prohibitTS;
        $prohibit_End = $prohibitDE.'#'.$prohibitTE;
        $date_time = date('Y-m-d H:i:s'); 

        if($prohibitDS!='NULL'||$prohibitTS!='NULL'||$prohibitDE!='NULL'||$prohibitTE!='NULL'){
            if($prohibitDS > $prohibitDE){
                return back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้<br>ข้อมูลวันที่งดจองไม่ถูกต้อง');
            }elseif($prohibitTS >= $prohibitTE){
                return back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้<br>ข้อมูลเวลางดจองไม่ถูกต้อง');
            }  
        }          

        $data = array('classrooms'=>$classrooms, 'numbers'=>$numbers, 'seats'=>$seats, 'prohibit_Start'=>$prohibit_Start, 'prohibit_End'=>$prohibit_End, "created_at"=>$date_time, "updated_at"=>$date_time,);

        $query = DB::table('classrooms')->where('numbers', '=', $numbers);
        $count = $query->count();
        if($count>='1'){
            return back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจากมีข้อมูลหมายเลขห้องของ \''.$numbers.'\' นี้อยู่แล้ว');
        }else{
            $insert = DB::table('classrooms')->insertGetId($data);

            $Class_detail_img = new Class_detail_img();
            $Class_detail_img->classrooms_id = $insert;
            $Class_detail_img->image = 'nopic.jpg';
            $Class_detail_img->preview = 1;
            $Class_detail_img->save();

            return ($insert) ? back()->with('Success', 'เพิ่มข้อมูลเรียบร้อย') : back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้ติดต่อผู้ดูแลระบบ');
        }
    }

    public function update(Request $request){
        $classrooms_id = $request->get('classrooms_id-edit');
        $classrooms = $request->get('classrooms-edit');   
        $numbers = $request->get('numbers-edit');
        $seats = $request->get('seats-edit');  
        $prohibitDS = ($request->get('prohibitDS-edit') != 0) ? $request->get('prohibitDS-edit') : 'NULL';
        $prohibitTS = ($request->get('prohibitTS-edit') != 0) ? $request->get('prohibitTS-edit') : 'NULL';
        $prohibitDE = ($request->get('prohibitDE-edit') != 0) ? $request->get('prohibitDE-edit') : 'NULL';
        $prohibitTE = ($request->get('prohibitTE-edit') != 0) ? $request->get('prohibitTE-edit') : 'NULL';
        $prohibit_Start = $prohibitDS.'#'.$prohibitTS;
        $prohibit_End = $prohibitDE.'#'.$prohibitTE;

        if($prohibitDS!='NULL'||$prohibitTS!='NULL'||$prohibitDE!='NULL'||$prohibitTE!='NULL'){
            if($prohibitDS > $prohibitDE){
                return back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้<br>ข้อมูลวันที่งดจองไม่ถูกต้อง');
            }elseif($prohibitTS >= $prohibitTE){
                return back()->with('Warning', 'ไม่สามารถเพิ่มข้อมูลได้<br>ข้อมูลเวลางดจองไม่ถูกต้อง');
            }  
        }
        
        $numbers_old = Classrooms::where('classrooms_id', $classrooms_id)->get(['numbers',]);
        $collection = collect($numbers_old);
        $numbers_old = $collection->implode('numbers', ', ');

        if((string)$numbers_old==$numbers)
        {
            // return 'old numbers';
            $Classrooms = Classrooms::find($classrooms_id);
            $Classrooms->classrooms = $classrooms;
            $Classrooms->seats = $seats;
            $Classrooms->prohibit_Start = $prohibit_Start;
            $Classrooms->prohibit_End = $prohibit_End;
            $Classrooms->save(); 

            return back()->with('Success', 'แก้ไขข้อมูลเรียบร้อย');

        }else if((string)$numbers_old!=$numbers)
        {
            // return 'new numbers';
            $query = DB::table('classrooms')->where('numbers', '=', $numbers);
            $count = $query->count();
            if($count>='1'){
                return back()->with('Warning', 'ไม่สามารถแก้ไขข้อมูลได้เนื่องจากมีข้อมูลหมายเลขห้องของ \''.$numbers.'\' นี้อยู่แล้ว');
            }else{
                $Classrooms = Classrooms::find($classrooms_id);
                $Classrooms->classrooms = $classrooms;
                $Classrooms->numbers = $numbers;
                $Classrooms->seats = $seats;
                $Classrooms->prohibit_Start = $prohibit_Start;
                $Classrooms->prohibit_End = $prohibit_End;
                $Classrooms->save(); 
                
                return back()->with('Success', 'แก้ไขข้อมูลเรียบร้อย');
            }      
        }
    }

    public function classrooms_del(Request $request){
        if($request->ajax()){
            $classrooms_id = $request->get('classrooms_id');
            $numbers = $request->get('numbers');
            
            $count = DB::table('class_detail_img')->where('classrooms_id', '=', $classrooms_id)->count();
            if($count!=0){
                File::deleteDirectory(public_path() . '/images/front/room/' . $numbers );
            }           

            $Classrooms = Classrooms::find($classrooms_id);
            $Classrooms->delete();

            return 'del';
        }
    }

    public function classrooms_status(Request $request){
        if($request->ajax()){
            $classrooms_id = $request->get('classrooms_id');

            $Classrooms = Classrooms::find($classrooms_id);
            $Classrooms->status = ($request->get('status')==1) ? 0 : 1 ;
            $Classrooms->save();

            return 'change';
        }
    } 

    //iframeSupport
    public function addSupport($name,$id){
        $id = $id;
        $name = $name;
        $data1 = DB::select( 
                    DB::raw("SELECT s.*
                            FROM classrooms_support AS s
                                WHERE s.classrooms_support_id 
                            NOT IN (
                                SELECT cds.classrooms_support_id
                                    FROM class_detail_support AS cds
                                LEFT JOIN classrooms_support AS cs
                                    ON cds.classrooms_support_id = cs.classrooms_support_id
                                WHERE cds.classrooms_id = $id 
                            )")
                );
        $data2 = DB::table('class_detail_support AS ds')
                ->join('classrooms_support AS s', 's.classrooms_support_id', '=', 'ds.classrooms_support_id')
                ->where('ds.classrooms_id', '=', $id)
                ->select('s.*')->get();
        return view('site.admin.classrooms.iframeSupport', compact(['name','id','data1','data2']))->render();
    }

    public function storeAddSupport(Request $request){
        if ($request->get('classrooms_support_id')) {
            Class_detail_support::where('classrooms_id', $request->get('classrooms_id'))->delete();

            for($i = 0; $i < count($request->classrooms_support_id); $i++) {
                $result[] = [
                    'classrooms_support_id' => $request->classrooms_support_id[$i],
                    'classrooms_id' => $request->classrooms_id,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime(),
                ];
            }
            Class_detail_support::insert($result);

            return back()->with('Success', 'เพิ่มข้อมูลเรียบร้อย');
        }
    }

    // iframeSoftwares
    public function addSoftwares($name,$id){
        $id = $id;
        $name = $name;
        // $data1 = DB::select( 
        //             DB::raw("SELECT s.*
        //             FROM softwares AS s
        //             LEFT JOIN class_detail_softwares AS ds
        //             ON s.softwares_id = ds.softwares_id
        //          EXCEPT
        //             SELECT s.*
        //             FROM softwares AS s
        //             RIGHT JOIN class_detail_softwares AS ds
        //             ON s.softwares_id = ds.softwares_id
        //             WHERE ds.classrooms_id = $id")
        //         );
        $data1 = DB::select( 
            DB::raw("SELECT s.*
                    FROM softwares AS s
                        WHERE s.softwares_id 
                    NOT IN (
                        SELECT cds.softwares_id
                            FROM class_detail_softwares AS cds
                        LEFT JOIN softwares AS cs
                            ON cds.softwares_id = cs.softwares_id
                        WHERE cds.classrooms_id = $id 
                    )")
        );
        $data2 = DB::table('class_detail_softwares AS ds')
                ->join('softwares AS s', 's.softwares_id', '=', 'ds.softwares_id')
                ->where('ds.classrooms_id', '=', $id)
                ->select('s.*')->get();
        return view('site.admin.classrooms.iframeSoftwares', compact(['name','id','data1','data2']))->render();
    }

    public function storeAddSoftwares(Request $request){
        if ($request->get('softwares_id')) {
            Class_detail_softwares::where('classrooms_id', $request->get('classrooms_id'))->delete();

            for($i = 0; $i < count($request->softwares_id); $i++) {
                $result[] = [
                    'softwares_id' => $request->softwares_id[$i],
                    'classrooms_id' => $request->classrooms_id,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime(),
                ];
            }
            Class_detail_softwares::insert($result);

            return back()->with('Success', 'เพิ่มข้อมูลเรียบร้อย');
        }
    }


    // iframeImage
    public function addImage($name,$id,$numbers){
        $id = $id;
        $name = $name;
        $numbers = $numbers;
        $data1 = Class_detail_img::where('classrooms_id', '=', $id)->where('preview', '=', '0')->get();
        $data2 = Class_detail_img::where('classrooms_id', '=', $id)->where('preview', '=', '1')->get();
        return view('site.admin.classrooms.iframeImage', compact(['name','id','numbers','data1','data2']))->render();
    }

    public function storeAddImage(Request $request){
        if ($request->hasFile('img')) {
            $filename = Str::random(10) . '.' . $request->file('img')->getClientOriginalExtension();
            $folder = $request->get('numbers');
            $request->file('img')->move(public_path() . '/images/front/room/'.$folder.'/', $filename); //save image
            $Class_detail_img = new Class_detail_img();
            $Class_detail_img->classrooms_id = $request->get('classrooms_id');
            $Class_detail_img->image = $folder.'/'.$filename;
            $Class_detail_img->preview = 0;
            $Class_detail_img->save();

            return back()->with('Success', 'เพิ่มข้อมูลเรียบร้อย');
        }
    }

    public function updatePreview(Request $request){
        if ($request->get('img')) {
            $id = $request->get('classrooms_id');
            $image = $request->get('img');
            if($image != 'nopic.jpg'){
                Class_detail_img::where('image', '=', 'nopic.jpg')->where('classrooms_id', '=', $id)->delete();
            }            
            
            Class_detail_img::where('classrooms_id', '=', $id)->update(['preview' => 0]);
            Class_detail_img::where('image', $image)->where('classrooms_id', '=', $id)->update(['preview' => 1]);
            return back()->with('Success', 'บันทึกข้อมูลเรียบร้อย');
        }        
    }
    
    public function delImage(Request $request){
        if ($request->get('ck_img')) {
            $image = $request->get('ck_img');

            foreach($image as $key => $value) {
                if(Class_detail_img::where('image', $value)->where('preview', '=', '1')->count() != 1){
                    Class_detail_img::where('image', $value)->delete();
                    if ($value != 'nopic.jpg') { 
                        File::delete(public_path() . '/images/front/room/' . $value);
                    }
                }else{
                    return back()->with('Warning', 'ไม่สามารถลบรูปภาพหลักได้');
                }
                if(end($image) == $value){
                    return back()->with('Success', 'ลบข้อมูลรูปภาพเรียบร้อย');
                }
            }

            
        }        
    }
}
