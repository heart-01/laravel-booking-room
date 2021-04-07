<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Semesters_Years;

class Semesters extends Model
{
    protected $table = 'semesters';

    protected $primaryKey = 'semesters_id';

    protected $fillable = [
        'semesters_id', 'semesters', 'semesters_start', 'semesters_end', 'semesters_status'
    ];

    public function assessment_form()
    {
        return $this->hasMany(Assessment_form::class,'semesters_id');
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class,'semesters_id')->where('bookings.status', 1)->orWhere('bookings.status', 2);
    }

    public static function searchAdmin($search)
    {
        $search = empty($search) ? $search : (int)$search-543 ;
        info($search);
        return empty($search) ? static::query()
            : static::query()->where('semesters', 'like', '%'.$search.'%');
    }

    public function scopeSemestersAll($query)
    {
        $query = DB::table('semesters AS s')
        ->select('*')
        ->orderBy("semesters_id", "desc");

        return $query;
    }

    public static function thai_date($datetime,$format,$clock)
    {
        $date = $datetime;
        // list($H,$i,$s) = split(':',$time);
        list($Y,$m,$d) = explode('-',$date);
        $Y = $Y+543;
        
        $month = array(
            '0' => array('01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน','07'=>'กรกฏาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤษจิกายน','12'=>'ธันวาคม'),
            '1' => array('01'=>'ม.ค.','02'=>'ก.พ.','03'=>'มี.ค.','04'=>'เม.ย.','05'=>'พ.ค.','06'=>'มิ.ย.','07'=>'ก.ค.','08'=>'ส.ค.','09'=>'ก.ย.','10'=>'ต.ค.','11'=>'พ.ย.','12'=>'ธ.ค.')
        );
        if ($clock == false)
            return $d.' '.$month[$format][$m].' '.$Y;
        else
            return $d.' '.$month[$format][$m].' '.$time;
    }

    public static function change_date($date)
    {
        $orgDate = $date;  
        $date = str_replace('-', '/', $orgDate);  
        $newDate = date('d/m/Y', strtotime('+543 year', strtotime($date)) ); 
        
        return $newDate;
    }

    public static function term_year($data)
    {
        $data = $data;
        list($year,$term) = explode('/',$data);
        
        $result = $term."/".($year+543);

        return $result;
    }

    public static function selectYear(){        
        // for($i=1; $i<=5; $i++){
        //     $Semesters_Years = new Semesters_Years;
        //     $Semesters_Years->years_id = (date("Y")-$i);
        //     $Semesters_Years->years = (date("Y")-$i)+543;
        //     $Semesters_Years->save();
        // }

        $ck_year = Semesters_Years::where('years_id', date("Y")+1)->count();
        
        if($ck_year==0){
            $data = [
                // ['years_id'=> date("Y"), 'years'=> (date("Y"))+543, 'created_at'=> date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')],
                ['years_id'=> (date("Y")+1), 'years'=> (date("Y")+1)+543, 'created_at'=> date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')],
            ];
            Semesters_Years::insert($data);
        }

        return Semesters_Years::all()->pluck('years', 'years_id');
    }

}
