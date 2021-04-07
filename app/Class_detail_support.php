<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_detail_support extends Model
{
    protected $table = 'class_detail_support';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'classrooms_id', 'classrooms_support_id',
    ];
}
