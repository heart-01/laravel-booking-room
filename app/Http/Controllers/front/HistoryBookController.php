<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException; 
use App\Events\UserLoggedIn;
use App\Bookings;
use App\Book_softwares;

class HistoryBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        event(new  UserLoggedIn("Your login has success"));
        return view('site.front.historyBook.index');
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
            return view('site.front.historyBook.displayUpdate', compact(['EncryptBookingsId','data','selSoftwares','otherSofware','nameClass']))->render();
        }else{
            App::abort(500, 'Error');
        }
    }
}
