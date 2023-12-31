@extends('layouts.mainlayout')

@section('title', 'Teacher')

@section('content')

    <h2>Detail Teacher name {{$teacher->name}}</h2>

    <div class="mt-5">
        <h3>
            Class :
            @if ($teacher->class)
                {{$teacher->class->name}}
            @else
            -
            @endif
        </h3>
    </div>

    <div class="mt-5">
        <h4>List Students</h4>
        @if ($teacher->class)
        <ol>
            @foreach ($teacher->class->students as $item)
                <li>{{$item->name}}</li>
            @endforeach
        </ol>
        @endif
    </div>
@endsection
