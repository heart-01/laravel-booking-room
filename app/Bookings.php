<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Bookings extends Model
{
    protected $table = 'bookings';

    protected $primaryKey = 'bookings_id';

    protected $fillable = [
        'bookings_id', 'users_id', 'classrooms_id', 'semesters_id', 'days', 'time_start', 'time_end', 'seats', 'fname', 'lname', 'email', 'tel', 'faculty', 'department', 'subject', 'course_code', 'part', 'status', 'approval',
    ];

    public function book_softwares() //กรณี bookings เป็น pk ดึงข้อมูลตาราง book_softwares เชื่อมด้วย bookings_id ในตาราง bookings
    {
        return $this->hasMany(Book_softwares::class,'bookings_id');
    }

    public function book_otherSofware()
    {
        return $this->hasMany(Book_softwares::class,'bookings_id')->where('book_softwares.otherSofware', '!=', null);
    }

    public function classrooms() //เชื่อม fk ตาราง bookings กับ classrooms ด้วย classrooms_id   //Bookings::with('book_softwares')->with('classrooms')->find($BookingsId);
    {
        return $this->belongsTo(Classrooms::class,'classrooms_id');
    }

    public function semesters()
    {
        return $this->belongsTo(Semesters::class,'semesters_id')->where('semesters_status', 1);
    }

    public static function searchHome($search)
    {
        if($search == 'จันทร์'){
            $search = '1';
        }else if($search == 'อังคาร'){
            $search = '2';
        }else if($search == 'พุธ'){
            $search = '3';
        }else if($search == 'พฤหัสบดี'){
            $search = '4';
        }else if($search == 'ศุกร์'){
            $search = '5';
        }else if($search == 'เสาร์'){
            $search = '6';
        }else{
            $search = $search;
        }
        return empty($search) 
            ? DB::table('bookings AS b')
                ->join('classrooms AS c', 'c.classrooms_id', '=', 'b.classrooms_id')
                ->join('semesters AS s', 's.semesters_id', '=', 'b.semesters_id')
                ->where('s.semesters_status', '=', 1)
                ->where('b.status', '!=', 0)
                ->select('*', 'b.status AS bookingStatus', 'b.seats AS bookingSeats')
            : DB::table('bookings AS b')
                ->join('classrooms AS c', 'c.classrooms_id', '=', 'b.classrooms_id')
                ->join('semesters AS s', 's.semesters_id', '=', 'b.semesters_id')
                ->where('s.semesters_status', '=', 1)
                ->where('b.status', '!=', 0)
                ->where('c.classrooms', 'like', '%'.$search.'%')
                ->orWhere('c.numbers', 'like', '%'.$search.'%')
                ->orWhere('b.fname', 'like', '%'.$search.'%')
                ->orWhere('b.lname', 'like', '%'.$search.'%')
                ->orWhere('b.course_code', 'like', '%'.$search.'%')
                ->orWhere('b.subject', 'like', '%'.$search.'%')
                ->orWhere('b.days', 'like', '%'.$search.'%')
                ->select('*', 'b.status AS bookingStatus', 'b.seats AS bookingSeats');
    }

    public static function searchFront($search)
    {
        return empty($search) 
            ? static::query()
                ->join('semesters AS s', 's.semesters_id', '=', 'bookings.semesters_id')
                ->join('classrooms AS c', 'c.classrooms_id', '=', 'bookings.classrooms_id')
                ->select('*','c.status AS classSta','bookings.status AS bookSta','bookings.created_at AS creatBook','bookings.seats AS bookSeats')
                ->where('users_id', '=', Auth::user()->id)
            : ((strlen((string)$search)==4) ?
              static::query()
                ->join('semesters AS s', 's.semesters_id', '=', 'bookings.semesters_id')
                ->join('classrooms AS c', 'c.classrooms_id', '=', 'bookings.classrooms_id')
                ->where('users_id', '=', Auth::user()->id)
                ->where('s.semesters', 'like', '%'.((int)$search-543).'%')
                ->select('*','c.status AS classSta','bookings.status AS bookSta','bookings.created_at AS creatBook','bookings.seats AS bookSeats')
            :
              static::query()
                ->join('semesters AS s', 's.semesters_id', '=', 'bookings.semesters_id')
                ->join('classrooms AS c', 'c.classrooms_id', '=', 'bookings.classrooms_id')
                ->where('users_id', '=', Auth::user()->id)
                ->where('c.numbers', 'like', '%'.$search.'%')
                ->select('*','c.status AS classSta','bookings.status AS bookSta','bookings.created_at AS creatBook','bookings.seats AS bookSeats'));
    }

    public static function searchAdmin($search)
    {
        return empty($search) 
            ? static::query()
                ->join('semesters AS s', 's.semesters_id', '=', 'bookings.semesters_id')
                ->join('classrooms AS c', 'c.classrooms_id', '=', 'bookings.classrooms_id')
                ->select('*','c.status AS classSta','bookings.status AS bookSta','bookings.created_at AS creatBook','bookings.seats AS bookSeats')
            : ((strlen((string)$search)==4) ?
              static::query()
                ->join('semesters AS s', 's.semesters_id', '=', 'bookings.semesters_id')
                ->join('classrooms AS c', 'c.classrooms_id', '=', 'bookings.classrooms_id')
                ->where('s.semesters', 'like', '%'.((int)$search-543).'%')
                ->select('*','c.status AS classSta','bookings.status AS bookSta','bookings.created_at AS creatBook','bookings.seats AS bookSeats')
            :
              static::query()
                ->join('semesters AS s', 's.semesters_id', '=', 'bookings.semesters_id')
                ->join('classrooms AS c', 'c.classrooms_id', '=', 'bookings.classrooms_id')
                ->where('c.numbers', 'like', '%'.$search.'%')
                ->select('*','c.status AS classSta','bookings.status AS bookSta','bookings.created_at AS creatBook','bookings.seats AS bookSeats'));
    }
}
