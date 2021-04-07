<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment_form extends Model
{
    protected $table = 'assessment_form';

    protected $primaryKey = 'assessment_form_id';

    protected $fillable = [
        'assessment_form_id', 'semesters_id', 'classrooms_id', 'status',
    ];

    public function question()
    {
        return $this->hasMany(Question::class,'assessment_form_id');
    }

    public function assessment()
    {
        return $this->hasMany(Assessment::class,'assessment_form_id');
    }

    public function semesters()
    {
        return $this->belongsTo(Semesters::class,'semesters_id');
    }

    public function classrooms()
    {
        return $this->belongsTo(Classrooms::class,'classrooms_id');
    }
}
