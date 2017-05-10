<?php

namespace  App\Services\v1;

use App\courses_rec;

class SchoolServices {
    public function getCourseRec() {
        return courses_rec::all();
    }
}