@extends('layouts.mainlayout')

@section('title', 'Students')

@section('content')

    <div class="mt-5">
        <h2>Are You sure to delete data : {{$student->name}} ({{$student->studid}})</h2>

        <form style="display: inline-block" action="/student-destroy/{{$student->id}}" method=POST>
            @csrf
            @method('delete')
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>

        <a href="/students" class="btn btn-primary">Cancel</a>

    </div>
@endsection
