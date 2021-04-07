<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionPrototype extends Model
{
    protected $table = 'question_prototype';

    protected $primaryKey = 'question_prototype_id';

    protected $fillable = [
        'question_prototype_id', 'article', 'question',
    ];
}
