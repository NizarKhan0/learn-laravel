@extends('layouts.mainlayout')

@section('title', 'Class')

@section('content')

    <h2>Detail Class {{$class->name}}</h2>

        <div class="mt-5">
            @if($class->homeroomTeacher)
            <h4>Homeroom Teacher : {{$class->homeroomTeacher->name}}</h4>
            @else
            -
            @endif
        </div>

        <div class="mt-5">
            <h4>Student List</h4>
            <ol>
                @foreach ($class->students as $item)
                    <li>{{$item->name}}</li>
                @endforeach
            </ol>
        </div>

@endsection
