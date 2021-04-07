<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = 'assessment';

    protected $primaryKey = 'assessment_id';

    protected $fillable = [
        'assessment_id', 'users_id', 'assessment_form_id', 'question_id', 'score', 'suggestion',
    ];
    
    public function assessment_form()
    {
        return $this->belongsTo(Assessment_form::class,'assessment_form_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class,'question_id');
    }
}
