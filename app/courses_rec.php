<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class courses_rec extends Model
{
    public function studentsTaking() {
        return $this->belongsTo('App\students', 'id');
    }

    public function courseTaken() {
        return $this->belongsTo('App\courses', 'id');
    }

    public function student () {
        return $this->belongsToMany('App\students', 'course_rec');
    }
}
