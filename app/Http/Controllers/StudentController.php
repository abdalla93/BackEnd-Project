<?php

namespace App\Http\Controllers;

use App\Models\EducationalStage;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required',
            'name' => 'required|string',
            'role_id'=>'required|max:50',
            'educational_stage_id'=>'required|max:50',
            'privilege_points'=>'required|max:50',
        ]);
        Role::findOrFail('role_id');
        EducationalStage::findOrFail('educational_stage_id');

        $user= new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->role_id=$request->role_id;
        $user->password = Hash::make($request->password);
        $user->save();
        $student=new Student();
        $student->user_id=$user->id;
        $student->privilege_points=$request->privilege_points;
        $student->educational_stage_id=$request->educational_stage_id;
        $student->save();
        return response()->json([
            'message'=>'student registered successful',
            'student' => $student
        ],201);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
