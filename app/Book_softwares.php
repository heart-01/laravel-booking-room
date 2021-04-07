<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_softwares extends Model
{
    protected $table = 'book_softwares';

    public $timestamps = false;

    protected $fillable = [
        'bookings_id', 'softwares_id', 'otherSofware',
    ];

    public function bookings()
    {
        return $this->belongsTo(Bookings::class);
    }
}
