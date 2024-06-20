<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class AnswerDetails extends Model
{
    use SoftDeletes;

    protected $table = 'AnswerDetails';
      protected $guarded = [];

/*
    public function user()
    {
        return $this->belongsTo('App\Models\UserHeaderResponses', 'user_response_id	');
    }
    */
    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id	');
    }

}