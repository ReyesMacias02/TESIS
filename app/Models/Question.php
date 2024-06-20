<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Question extends Model
{


    protected $table = 'Questions';

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz', 'quiz_id');
    }


}