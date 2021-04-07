<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_User extends Model
{
    protected $table = 'status_user';

    protected $fillable = [
        'status_id', 'name',
    ];
}
