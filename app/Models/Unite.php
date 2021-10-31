<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    public function secteur(){
        return $this->belongsTo(Secteur::class);
    }
}
