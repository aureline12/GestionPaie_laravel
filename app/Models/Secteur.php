<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    public function unites(){

        return $this->hasMany(Unite::class);
    }

}
