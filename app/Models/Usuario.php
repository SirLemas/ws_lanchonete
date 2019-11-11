<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $hidden = ['senha','created_at', 'updated_at', 'deleted_at'];
}
