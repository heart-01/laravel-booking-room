<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UserLoggedIn;
use Illuminate\Support\Facades\DB;
use App\Class_detail_img;
use App\Class_detail_softwares;
use App\Class_detail_support;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'showDetail','index','contact'
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        event(new  UserLoggedIn("Your login has success"));

        $data_classrooms = DB::table('classrooms AS c')
                ->join('class_detail_img AS dm', 'dm.classrooms_id', '=', 'c.classrooms_id')
                ->where('dm.preview', '=', 1)
                ->where('c.status', '=', 1)
                ->orderBy('c.classrooms_id', 'DESC')
                ->select('*')->get();        

        return view('site.front.index', compact(['data_classrooms']))->render();
    }

    public function showDetail($name,$id){
        $name = $name;
        $classrooms_id = $id;

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

        return view('site.front.iframeDetail', compact(['name','sup','sof','imgPre','img']))->render();
    }

    public function contact()
    {
        return view('site.front.contact');
    }
}
