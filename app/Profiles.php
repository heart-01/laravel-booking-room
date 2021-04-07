<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Profiles extends Model
{
    use Notifiable;

    protected $table = 'profiles';

    protected $fillable = [
        'id', 'tel', 'status_id', 'image',
    ];

    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo(User::class);
    }

}
