<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cardapio extends Model
{

    public $timestamps = false;
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    
    public function usuario() {
        return $this->belongsTo('App\Models\Usuario');
    }
}
