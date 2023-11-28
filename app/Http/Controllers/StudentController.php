<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use Laracasts\Flash\Flash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Extracurricular;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StudentCreateRequest;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // $nama = "budi";
        //elaquent orm(recomend)
        //query builder(average)
        //raw query(not rec)
        //$student = Student::all(); // lazy loading
        $keyword = $request->keyword;

        // select * from students(eager loading)
        $student = Student::with('class')
        ->where('name', 'LIKE', '%'.$keyword.'%')
        ->orWhere('gender' , $keyword)
        ->orWhere('studid', 'LIKE', '%'.$keyword.'%')
        ->orWhereHas('class', function($query) use($keyword){
            $query->where('name','LIKE', '%'.$keyword.'%');
        })
        ->paginate(15);
        return view('student', ['studentList'=>$student]);

        //query builder
        // $student = DB::table('students')->get();
        // dd($student);
        // DB::table('students')->insert([
        //     'name' => 'query',
        //     'gender' => 'L',
        //     'studid' => '123456',
        //     'class_id' => '1'
        // ]);
        // DB::table('students')->where('id', 27)->update([
        //     'name' => 'query2',
        //     'class_id' => '3'
        //     ]);
        // DB::table('students')->where('id', 26)->delete();


        //eloquent
        // $student = Student::all();
        // dd($student);
        // Student::create([
        //     'name' => 'eloquent',
        //     'gender' => 'P',
        //     'studid' => '123452',
        //     'class_id' => '2'
        // ]);
        // Student::find(26)->update([
        //     'name' => 'eloquent 2',
        //     'class_id' => '2'
        // ]);
        // Student::find(27)->delete();


        //!Method yang biasa digunakan di laravel

        // $int = [9, 8, 7, 6, 5, 4, 3, 2, 1, 5, 2, 6, 3, 5, 2, 1, 10];

        //php (3 step)
        //1. Total
        //2. How much total
        //3. Average total = int/total in

        // $countInt = count($int);
        // $totalInt = array_sum($int);
        // $intAverage = $totalInt / $countInt;

        // dd($intAverage);

        //collection (1 step)
        //1. Average total

        // $intAverage = collect($int)->avg();

        //method
        //1)contais = check if have data in array

        // $aaa = collect($int)->contains(function ($value) {
        //     return $value < 6;
        // });
        // dd($aaa);

        //2)diff = bezakan data dalam array

        // $restaurantA = ["burger", "siomay", "pizza", "spaghetti", "makaroni", "martabak", "bakso"];
        // $restaurantB = ["pizza","fried chicken","martabak", "sayur asam","pecel lele", "bakso" ];

        // $menuRestoA = collect($restaurantA)->diff($restaurantB);
        // $menuRestoB = collect($restaurantB)->diff($menuRestoA);
        // dd($menuRestoB);

        //3)filter = saring data in array

        // $aaa = collect($int)->filter(function ($value) {
        //     return $value > 7;
        // })->All();

        // dd($aaa);

        //4) pluck (cari mana yang nak sahaja contoh klau nk nama saje)

        // $biodata = [
        //     ['nama' => 'budi', 'umur' => 17],
        //     ['nama' => 'ani', 'umur' => 16],
        //     ['nama' => 'siti', 'umur' => 17],
        //     ['nama' => 'rudi', 'umur' => 20],
        // ];

        // $aaa = collect($biodata)->pluck('umur')->all();
        // dd($aaa);

        //5)map (looping) mencari tahu hasil daripada nila didarab dua dari array $int)

        //php looping
        // $nilaiDarabDua = [];
        // foreach ($int as $value) {
        //     array_push($nilaiDarabDua, $value * 2);
        // }
        // dd($nilaiDarabDua);

        // $aaa = collect($int)->map(function ($value){
        //     return $value * 2;
        // })->all();

        // dd($aaa);
    }

    public function show($slug)
    {
        $student = student::with(['class.homeroomTeacher','extracurriculars'])
        ->where('slug', $slug)->first();
        return view('student-detail', ['student'=>$student]);
    }

    public function create()
    {
        $class = ClassRoom::select('id', 'name')->get();
        return view('student-add', ['class' => $class]);
    }

    public function store(StudentCreateRequest $request)
    {
        // $student = new Student;
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->studid = $request->studid;
        // $student->class_id = $request->class_id;
        // $student->save();

        $newName = '';

        if($request->File('photo')){
        $extension = $request->file('photo')->getClientOriginalExtension();
        $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
        $request->file('photo')->storeAs('photo', $newName);
        }

        $request['image'] = $newName;
        //$request ['slug'] = Str::slug($request->name, '-');
        $student = Student::create($request->all());

        if ($student) {
            Session::flash('add', 'success');
            Session::flash('message','add new student success!');
        }
        return redirect('/students');
    }

    public function edit(Request $request, $slug)
    {
        $student = Student::with('class')->where('slug', $slug)->first();
        $class = ClassRoom::where('id', '!=', $student->class_id)->get(['id','name']);
        return view('student-edit', ['student'=> $student, 'class'=> $class]);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->studid = $request->studid;
        // $student->class_id = $request->class_id;

        // $student->save();

        if($student){
            Session::flash('update', 'success');
            Session::flash('message','upadate success');
        }

        $student->update($request->all());
        return redirect('/students');
    }

    public function delete($slug)
    {
        $student = Student::where('slug', $slug)->first();
        return view('student-delete', ['student'=> $student]);
    }

    public function destroy($id)
    {
        //query builder
        //$deleteStudent = DB::table('students')->where('id', $id)->delete();


        $deletedStudent = Student::findOrFail($id);
        $deletedStudent->delete();

        if ($deletedStudent)
        {
            Session::flash('delete','success');
            Session::flash('message','Delete data success!');
        }
        return redirect('/students');
    }

    public function deletedStudent()
    {
        $deletedStudent = Student::onlyTrashed()->get();
        return view('student-deleted-list', ['student' => $deletedStudent]);
    }

    public function restore($slug)
    {
        $deletedStudent = Student::withTrashed()->where('slug', $slug)->restore();

        if ($deletedStudent)
        {
            Session::flash('update','success');
            Session::flash('message','Restore data success!');
        }
        return redirect('/students');
    }

    // public function massUpdate()
    // {
    //     $student = Student::whereNull('slug')->get();
    //     collect($student)->map(function($item){
    //         $item->slug = Str::slug($item->name, '-');
    //         $item->save();
    //     });
    // }
}