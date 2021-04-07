<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classrooms extends Model
{
    protected $table = 'classrooms';

    protected $primaryKey = 'classrooms_id';

    protected $fillable = [
        'classrooms_id', 'classrooms', 'numbers', 'seats',
    ];

    public function assessment_form()
    {
        return $this->hasMany(Assessment_form::class,'classrooms_id');
    }

    public function scopeClassroomsAll($query)
    {
        $query = DB::table('classrooms AS c')
        ->select('*')
        ->orderBy("classrooms_id", "desc");

        return $query;
    }

    public static function Droom($days = null)
    {
        $prohibitD = array(1 =>'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์');

        if(!empty($days)){
            return $prohibitD[$days];
        }else{            
            return $prohibitD;
        }        
    }

    public static function Troom()
    {
        $prohibitT = array();
        for($i = 8; $i <= 21; $i++){
            for($j=0;$j<=1;$j++){
                if($j==0){
                    $prohibitT[$i.'.00'] = ($i<=9) ? '0'.$i.':'.(($j==0)?'00':'30') : ( $i.':'.(($j==0)?'00':'30') );
                }else if($j==1 && $i!=21){
                    $prohibitT[$i.'.30'] = ($i<=9) ? '0'.$i.':'.(($j==0)?'00':'30') : ( $i.':'.(($j==0)?'00':'30') );
                }
            }
        } 
        return $prohibitT;
    }

    public static function status($id,$sta = null)
    {
        if(!empty($sta)){
            $status = array(0 =>'ยกเลิก', 'รออนุมัติ', 'อนุมัติ', 'สิ้นสุด');
            return $status[$id];
        }else{            
            $status = array(0 =>'<p class="text-danger"><i class="fas fa-ban"></i> ยกเลิก</p>', 
            '<p class="text-warning"><i class="far fa-clock"></i> รออนุมัติ</p>',
            '<p class="text-success"><i class="fas fa-clipboard-check"></i> อนุมัติ</p>',
            '<p class="text-primary"><i class="far fa-check-circle"></i> สิ้นสุด</p>'
            );
            return $status[$id];
        }
               
    }

    public static function prohibitDate()
    {
        $prohibitD = array(0 =>'--', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์');

        return $prohibitD;
    }

    public static function prohibitTime()
    {
        $prohibitT = array();
        for($i = 8; $i <= 21; $i++){
            $prohibitT[0] = '--:--';
            for($j=0;$j<=1;$j++){
                if($j==0){
                    $prohibitT[$i.'.00'] = ($i<=9) ? '0'.$i.':'.(($j==0)?'00':'30') : ( $i.':'.(($j==0)?'00':'30') );
                }else if($j==1 && $i!=21){
                    $prohibitT[$i.'.30'] = ($i<=9) ? '0'.$i.':'.(($j==0)?'00':'30') : ( $i.':'.(($j==0)?'00':'30') );
                }
            }
        } 
        return $prohibitT;
    }

    public static function prohibit($prohibit_Start,$prohibit_End)
    {
        // $prohibitT = array();
        // for($i = 8; $i <= 21; $i++){
        //     $prohibitT[0] = '--:--';
        //     $prohibitT[$i] = ($i<=9) ? '0'.$i.':00' : $i.':00' ;  
        // } 
        $prohibitT = array();
        for($i = 8; $i <= 21; $i++){
            $prohibitT[0] = '--:--';
            for($j=0;$j<=1;$j++){
                if($j==0){
                    $prohibitT[$i.'.00'] = ($i<=9) ? '0'.$i.':'.(($j==0)?'00':'30') : ( $i.':'.(($j==0)?'00':'30') );
                }else if($j==1 && $i!=21){
                    $prohibitT[$i.'.30'] = ($i<=9) ? '0'.$i.':'.(($j==0)?'00':'30') : ( $i.':'.(($j==0)?'00':'30') );
                }
            }
        } 
        $prohibitD = array(0 =>'--', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์');

        $prohibit_Start = explode('#',$prohibit_Start);
        $prohibit_End = explode('#',$prohibit_End);
        
        $prohibitDS = ($prohibit_Start[0] != 'NULL') ? $prohibitD[$prohibit_Start[0]].' - ' : '-';
        $prohibitDE = ($prohibit_End[0] != 'NULL') ? $prohibitD[$prohibit_End[0]].'<br>' : '';
        $prohibitTS = ($prohibit_Start[1] != 'NULL') ? $prohibitT[$prohibit_Start[1]].' - ' : '';
        $prohibitTE = ($prohibit_End[1] != 'NULL') ? $prohibitT[$prohibit_End[1]].'' : '';

        return $prohibitDS.$prohibitDE.$prohibitTS.$prohibitTE;
    }

    public static function dataProhibit($data,$ck)
    {        
        $prohibit = explode('#',$data);

        if($ck==1){
            $prohibitDS = $prohibit[0];
        }else if($ck==2){
            $prohibitTS = $prohibit[1];
        }else if($ck==3){
            $prohibitDE = $prohibit[0];
        }else{
            $prohibitTE = $prohibit[1];
        }
        
        return ($ck==1) ? $prohibitDS : ( ($ck==2) ? $prohibitTS : ( ($ck==3) ? $prohibitDE : $prohibitTE ) );
    }


}
