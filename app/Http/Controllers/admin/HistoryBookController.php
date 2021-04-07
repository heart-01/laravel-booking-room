<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException; 
use App\Events\UserLoggedIn;
use App\Bookings;
use App\Book_softwares;
use App\User;

class HistoryBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => [
            'showHistory',
        ]]);
    }

    public function index()
    {
         $notificat_is_admin = Auth::user()->notificat_is_admin; //เช็คว่าใช่ admin ไหม
         $notificat_is_admin = ($notificat_is_admin) ? Auth::user()->notificat_is_admin->unreadNotifications : null; //ดึงการแจ้งเตือน admin
        return view('site.admin.historyBook.index', compact(['notificat_is_admin']))->render();
    }

    public function showUpdate(Request $request)
    {
        if($request->BookingsId){
            $BookingsId = decrypt($request->BookingsId);
            
            $data = Bookings::with('book_softwares')->with('classrooms')->find($BookingsId);
            // $softwares = Bookings::with(["book_softwares" => function($q){
            //     $q->where('book_softwares.otherSofware', '=', null);
            // }])->find($BookingsId);
            // $data = Bookings::with('book_softwares')->find($BookingsId);

            $selSoftwares = $data->book_softwares->pluck('softwares_id')->filter();
            $otherSofware = $data->book_softwares->pluck('otherSofware')->filter()->all();
            
            $classrooms = $data->classrooms->classrooms;
            $numbers = $data->classrooms->numbers;
            $nameClass = $classrooms.' '.$numbers;
            // info($nameClass);
            
            $EncryptBookingsId = Crypt::encrypt($BookingsId);
            return view('site.admin.historyBook.displayUpdate', compact(['EncryptBookingsId','data','selSoftwares','otherSofware','nameClass']))->render();
        }else{
            App::abort(500, 'Error');
        }
    }

    public function approve(Request $request){
        if($request->ajax()){
            $BookingsId = decrypt($request->BookingsId);
            $Bookings = Bookings::find($BookingsId);
            $Bookings->status = '2';
            $Bookings->approval = Auth::user()->id;
            $saved = $Bookings->save();

            if($saved){
                $data = Bookings::with('book_softwares')->with('classrooms')->find($BookingsId);

                $classrooms = $data->classrooms->classrooms;
                $numbers = $data->classrooms->numbers;
                $nameClass = $classrooms.' '.$numbers;
    
                $detail = [
                    'fname' => $data->fname,
                    'lname' => $data->lname,
                    'message' => "ได้รับการอนุมัติการจอง ".$nameClass." เรียบร้อยแล้ว..",
                ];        
                \Mail::to($data->email)->send(new \App\Mail\BookingsMail($detail));
                
                return 'success';  
            }else{
                return 'unsuccess' ;
            }            
        }
    }

    public function showHistory($id){
        $BookingsId = decrypt($id);
        $data = Bookings::with('book_softwares')->with('classrooms')->find($BookingsId);

        $selSoftwares = $data->book_softwares->pluck('softwares_id')->filter();
        $otherSofware = $data->book_softwares->pluck('otherSofware')->filter()->all();

        $classrooms_id = $data->classrooms->classrooms_id;
        $classrooms = $data->classrooms->classrooms;
        $numbers = $data->classrooms->numbers;
        $nameClass = $classrooms.' '.$numbers;

        $href = $nameClass.'/'.$classrooms_id;

        return view('site.admin.historyBook.iframeShowHistory', compact(['BookingsId','data','selSoftwares','otherSofware','classrooms','nameClass','href']))->render();
    }

    public function markNotification(Request $request)
    {
        Auth::user()->notificat_is_admin
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }
}
