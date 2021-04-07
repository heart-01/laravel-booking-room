<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';

    protected $primaryKey = 'question_id';

    protected $fillable = [
        'question_id', 'assessment_form_id', 'article', 'question',
    ];

    public function assessment()
    {
        return $this->hasMany(Assessment::class,'question_id');
    }

    public function assessment_form()
    {
        return $this->belongsTo(Assessment_form::class,'assessment_form_id');
    }
}
