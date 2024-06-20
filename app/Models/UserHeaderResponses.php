<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class UserHeaderResponses extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'UserHeaderResponses';

    public function respuesta()
    {
        return $this->hasMany('App\Models\AnswerDetails', 'user_response_id');
    }




}