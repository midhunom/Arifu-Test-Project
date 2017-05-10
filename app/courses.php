<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    public function coursesRec() {
        return $this->belongsToMany('App\courses_rec');
    }
}
