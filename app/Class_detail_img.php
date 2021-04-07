<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_detail_img extends Model
{
    protected $table = 'class_detail_img';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'classrooms_id', 'image', 'preview',
    ];
}
