<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Record;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule ;

class RecordController extends Controller
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
            'student_id' => 'required|max:50',
            'record_id' => 'required',
            'record_type' => [
                'required',
                Rule::in(['subject', 'chapter','lesson']),
            ],
        ]);
        $student=Student::findOrFail($request->student_id);

        //student Applied for a Subject
        if($request->record_type == 'subject'){
            $subject=Subject::findOrFail($request->record_id);
            $cost=$student->privilege_points-$subject->privilege_cost;
            if($cost<0)
            {
                return response()->json([
                    'message'=>'student does not have enough points for '+$subject->name
                ],422 );
            }
            $student->privilege_points=$cost;
            $student->save();
            $subject->records()->create(['student_id'=>$request->student_id,'privilege_cost'=>$subject->privilege_cost]);

        //student Applied for a Chapter
        }elseif($request->record_type == 'chapter')
        {
            $chapter=Chapter::findOrFail($request->record_id);
            $cost=$student->privilege_points-$chapter->privilege_cost;
            if($cost<0)
            {
                return response()->json([
                    'message'=>'student does not have enough points '+$chapter->name
                ],422 );
            }
            $student->privilege_points=$cost;
            $student->save();
            $chapter->records()->create(['student_id'=>$request->student_id,'privilege_cost'=>$chapter->privilege_cost]);
        }

        //student Applied for a Lesson
        elseif($request->record_type == 'lesson')
        {

            $lesson=Lesson::findOrFail($request->record_id);
            $cost=$student->privilege_points-$lesson->privilege_cost;
            if($cost<0)
            {
                return response()->json([
                    'message'=>'student does not have enough points '+$lesson->name
                ],422 );
            }
            $student->privilege_points=$cost;
            $student->save();
            $lesson->records()->create(['student_id'=>$request->student_id,'privilege_cost'=>$lesson->privilege_cost]);
        }
        return response()->json([
            'message'=>'student applied successful',
            'student' => $student
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Records  $records
     * @return \Illuminate\Http\Response
     */
    public function show(Records $records)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Records  $records
     * @return \Illuminate\Http\Response
     */
    public function edit(Records $records)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Records  $records
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Records $records)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Records  $records
     * @return \Illuminate\Http\Response
     */
    public function destroy(Records $records)
    {
        //
    }
}
