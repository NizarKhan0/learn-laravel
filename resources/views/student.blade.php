@extends('layouts.mainlayout')

@section('title', 'Students')

@section('content')
        <h1>Student Page</h1>

        <div class="my-5 d-flex justify-content-between">
            @if(Auth::user()->role_id != 3)
            <a href="student-add" class="btn btn-primary">Add Data</a>
            @endif

            @if(Auth::user()->role_id == 1)
            <a href="student-deleted" class="btn btn-warning">Show Deleted Data</a>
            @endif
        </div>

        @if(Session::has('add'))
            <div class="alert alert-success" role="alert">
                {{Session::get('message')}}
            </div>
        @endif

        @if(Session::has('update'))
        <div class="alert alert-primary" role="alert">
            {{Session::get('message')}}
        </div>
        @endif

        @if(Session::has('delete'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('message')}}
        </div>
        @endif

        <h3>Student List</h3>

        <div class="my-3 col-12 col-sm-8 col-md-5">
            <form action="" method="GET">
                <div class="input-group mb-3">
                <input type="text" class="form-control" name="keyword" placeholder="keyword">
                <button class="btn btn-primary input-group-text">Search</button>
            </div>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Student ID</th>
                    <th>Class</th>
                    <th>Action</th>
                </tr>
                <tbody>
                    @foreach ($studentList as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->gender}}</td>
                        <td>{{$data->studid}}</td>
                        <td>{{$data->class->name}}</td>
                        <td>
                            @if(Auth::user()->role_id != 1 && Auth::user()->role_id !=2)
                                -
                            @else
                            <a href="student/{{$data->slug}}">Detail</a> |
                            <a href="student-edit/{{$data->slug}}">Edit</a> |
                            @endif

                            @if(Auth::user()->role_id == 1)
                            <a href="student-delete/{{$data->slug}}">Delete</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>

        <div class="my-5">
        {{$studentList->withQueryString()->links()}}
        </div>

        <x-alert message='ini adalah student page' type='primary'/>
@endsection
