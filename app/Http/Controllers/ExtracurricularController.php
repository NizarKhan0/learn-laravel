<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Extracurricular;
use Illuminate\Support\Facades\Session;

class ExtracurricularController extends Controller
{
    public function index(){
        $ekskul = Extracurricular::get();
        return view('extracurricular', ['ekskulList'=> $ekskul]);
    }

        public function show($id)
    {
        $ekskul = Extracurricular::with('students')
        ->findOrFail($id);
        return view('extracurricular-detail', ['ekskul'=>$ekskul]);
    }

    public function create()
    {
        $ekskul = Extracurricular::all();
        return view('extracurricular-add', ['ekskul'=>$ekskul]);
    }

    public function store(Request $request)
    {
        $extracurricular = Extracurricular::create($request->all());

        if($extracurricular){
            Session::flash('add','success');
            Session::flash('message','add new extracurricular success!');
        }

        return redirect('/extracurricular');
    }
}