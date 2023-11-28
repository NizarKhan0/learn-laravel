<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;

class ClassController extends Controller
{
        public function index()
    {
        //lazy laod
        //$class  = ClassRoom::all(); //cara request data bila diperlukan
        //select * from table class
        //select * from student where class = 1A
        //select * from student where class = 1A
        //select * from student where class = 1A
        //select * from student where class = 1A

        //eager laod
        $class = ClassRoom::get(); //cara request data
        //select * from table class
        //select * from student where class in (1a,1b,1c,1d)
        return view('classroom', ['classList'=>$class]);
    }

    public function show($id)
    {
        $class = ClassRoom::with(['students','homeroomTeacher'])
        ->findOrFail($id);
        return view('class-detail', ['class'=>$class]);
    }

        public function create()
    {
        $class = ClassRoom::with(['teachers', 'homeroomTeacher']);
        return view('class-add' , ['class'=>$class]);
    }

    public function store(Request $request)
    {
        $class = ClassRoom::create($request->all());

        if ($class) {
        Session::flash('add', 'success');
        Session::flash('message','add new class success!');
        }

        return redirect('/class');
    }

}