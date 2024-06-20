<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Quiz extends Model
{


    protected $table = 'Quiz';

  public function pregunta()
    {
        return $this->hasMany('App\Models\Question', 'quiz_id');
    }


}