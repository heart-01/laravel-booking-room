<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semesters_Years extends Model
{
    protected $table = 'semesters_years';

    protected $primaryKey = 'years_id';

    protected $keyType = 'string';

    public $incrementing = false; //สิ่งนี้จะหยุดไม่ให้คิดว่าเป็นช่องเพิ่มอัตโนมัติ
    
    protected $fillable = [
        'years_id', 'years',
    ];
}
