@extends('layouts.mainlayout')

@section('title', 'Teachers')

@section('content')
        <h1>Teacher Page</h1>

        <div class="my-5">
            <a href="teacher-add" class="btn btn-primary">Add Data</a>
        </div>

        @if(Session::has('add'))
            <div class="alert alert-success" role="alert">
                {{Session::get('message')}}
            </div>
        @endif

        <h3>Teacher List</h3>

        <table class="table">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($teacherList as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td><a href="teacher-detail/{{$item->id}}">Detail</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>


@endsection
