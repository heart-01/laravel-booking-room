<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classrooms_Support extends Model
{
    protected $table = 'classrooms_support';

    protected $primaryKey = 'classrooms_support_id';

    protected $fillable = [
        'classrooms_support_id', 'classrooms_support',
    ];

    public function scopeClassrooms_supportAll($query)
    {
        $query = DB::table('classrooms_support AS c')
        ->select('*')
        ->orderBy("classrooms_support_id", "desc");

        return $query;
    }
}
