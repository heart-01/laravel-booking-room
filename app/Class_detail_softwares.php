<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_detail_softwares extends Model
{
    protected $table = 'class_detail_softwares';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'classrooms_id', 'softwares_id',
    ];
}
