<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Usuario extends Model
{
    use SoftDeletes;

    protected $table = 'usuario';




}