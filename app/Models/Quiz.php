<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

    protected $table = 'Quiz';
    protected $fillable = ['name', 'descripcion', 'desde', 'hasta', 'estado'];

    public function pregunta()
    {
        return $this->hasMany('App\Models\Question', 'quiz_id');
    }

}