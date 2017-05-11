<?php

namespace  App\Services\v1;

use App\courses;
use App\courses_rec;
use App\students;
use Illuminate\Support\Facades\DB;

class SchoolServices {

    public function createStudent($req,$name, $email, $gender) {

//        ** http://localhost:8000/user/$name/$email/$gender **
        return DB::table('students')->insert(
            array(
                'full_name' => $name,
                'email' => $email,
                'gender' => $gender
            )
        );


    }

    public function getCourseRec() {

        return courses::all();
    }

    public function getAllStudents($parameters) {
        if(empty($parameters)){
            return $this->filterStudentsInfo(students::all());
        }

        if (isset($parameters['course'])){
            $includeParam = explode(',', $parameters['course']);
            return $this->getStudentApplied($includeParam);
        }elseif (isset($parameters['date'])){
            $includeParam = explode(',', $parameters['date']);
            return $this->getDailyReq($includeParam);
        }elseif (isset($parameters['certs'])){
            return $this->getCertsIssued();
        }elseif (isset($parameters['create'])) {
            $includeParam = explode(',', $parameters['create']);
            return $this->createStudent();
        }elseif (isset($parameters['courses'])) {
            return $this->getCourseRec();
        }

    }


    public function getStudentInfo($id) {

        return DB::table('students')
            ->select([
                'students.id', 'students.full_name', 'courses_recs.course_id', 'courses.cousrse_name', 'courses_recs.joined_at', 'courses_recs.status'
            ])
            ->leftJoin('courses_recs', 'courses_recs.student_id', '=', 'students.id')
            ->leftJoin('courses', 'courses_recs.course_id', '=', 'courses.id' )
            ->where('students.id',$id)->get();
    }

    public function filterStudentsInfo($students) {

        $data = [];

        foreach ($students as $student) {
            $entry = [
              'fullname' => $student->full_name,
              'email' => $student->email,
              'gender' => $student->gender,
              'href' => route('school.show', ['id' => $student->id])
            ];
            $data[] = $entry;
        }
         return $data;

    }

    public function getStudentApplied($keys = []) {

//        **http://localhost:8000/api/v1/school?course=2**
        return DB::table('courses_recs')
            ->select([DB::raw('COUNT(id) AS Num_students'), 'status'])
            ->groupBy('status')
            ->where('course_id',$keys[0])
            ->get();
    }

    public function getDailyReq($keys = []) {

//        **http://localhost:8000/api/v1/school?date=2,2017-05-10,2017-05-12**
        $records = [];

        $init_date = strtotime("$keys[1]");
        $start_date = strtotime("$keys[1]");
        $end_date = strtotime("$keys[2]");

        $datediff = $end_date - $start_date;

       $days = floor($datediff / (60 * 60 * 24));

       for ($d = 0; $d<$days; $d++) {
           $start_date = strtotime("+1 day",$start_date);
           $records[] = date('Y-m-d', $start_date);
       }

       array_unshift($records, date('Y-m-d', $init_date));

       $data = [];

       foreach ($records as $record){
           $entry =  DB::table('courses_recs')
               ->select([DB::raw('count(id) AS Applications')])
               ->where('course_id', $keys[0])
               ->whereBetween('joined_at', array($record, $record))
               ->get();

           $show = [
               $record => $entry
           ];
           $data[] = $show;
       }

        return $data;
    }

    public function getCertsIssued() {

//        **http://localhost:8000/api/v1/school?certs=1**
        $data = [];
        $entries = $this->getCourseRec();

        foreach ($entries as $entry) {
            $rec = [
                'id' => $entry->id
            ];
            $data[] = $rec;
        }

        $show = [];

        for ($d=0; $d<count($data); $d++) {
               $record = DB::table('courses_recs')
               ->select([DB::raw('COUNT(courses_recs.id) AS Certs_issued'),'courses.cousrse_name'])
               ->Join('courses', 'courses_recs.course_id', '=', 'courses.id')
               ->groupBy('courses.cousrse_name')
               ->where('course_id',$data[$d])
               ->where('status', 'complete')
               ->get();

               $show[] =  $record;
        }
        return $show;

    }
}