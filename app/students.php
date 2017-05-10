<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    public function coursesReg() {
        return $this->belongsToMany('APP\courses_rec');
    }
}
