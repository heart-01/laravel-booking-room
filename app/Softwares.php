<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Softwares extends Model
{
    protected $table = 'softwares';

    protected $primaryKey = 'softwares_id';

    protected $fillable = [
        'softwares_id', 'softwares',
    ];

    public function scopeSoftwaresAll($query)
    {
        $query = DB::table('softwares AS s')
        ->select('*')
        ->orderBy("softwares_id", "desc");

        return $query;
    }
}
