<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\schoolServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class schoolController extends Controller
{

    protected $courses;
    public function __construct(schoolServices $schoolService) {
            $this->courses = $schoolService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parameters = request()->input();
        $data= $this->courses->getAllStudents($parameters);
        return response()->json($data);


    }

    public function insert(Request $request, $name, $email, $gender){
        try{
            $studentInfo = $this->courses->createStudent($request,$name, $email, $gender);
            return request()->json($studentInfo, 201);
        }catch (Exception $e){
            return request()->json(['Message' => $e], 500 );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= $this->courses->getStudentInfo($id);
        return response()->json($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
