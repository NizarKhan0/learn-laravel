@extends('layouts.mainlayout')

@section('title', 'Extracurricular')

@section('content')

    <h2>Detail extracurricular {{$ekskul->name}}</h2>

    <div class="mt-5">
        <h3>List student</h3>
        <ol>
        @foreach ($ekskul->students as $item)
            <li>{{$item->name}}</li>
        @endforeach
        </ol>
    </div>

@endsection
