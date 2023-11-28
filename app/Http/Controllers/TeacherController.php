<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    function index(){
        $teacher = Teacher::all();// select * from students(eager loading)
        return view('teacher', ['teacherList'=>$teacher]);
    }

        function show($id)
        {
        $teacher = Teacher::with('class.students')
        ->findOrFail($id);// select * from students(eager loading)
        return view('teacher-detail', ['teacher'=>$teacher]);
    }

    public function create()
    {
        $teacher = Teacher::all();
        return view('teacher-add', ['teacher'=>$teacher]);
    }

    public function store(Request $request)
    {
        $teacher = Teacher::create($request->all());


        if($teacher){
            Session::flash('add', 'success');
            Session::flash('message','add new teacher success!');
        }

        return redirect('/teacher');
    }
}