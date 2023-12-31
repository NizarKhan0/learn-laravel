@extends('layouts.mainlayout')

@section('title', 'Class')

@section('content')
        <h1>Class Page</h1>

        <div class="my-5">
            <a href="class-add" class="btn btn-primary">Add Data</a>
        </div>

        @if(Session::has('add'))
            <div class="alert alert-success" role="alert">
                {{Session::get('message')}}
            </div>
        @endif

        <h3>Class List</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classList as $data)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$data->name}}</td>
                    <td><a href="class-detail/{{$data->id}}">Detail</a></td>
                <td>
                @endforeach
            </tbody>
        </table>
@endsection
