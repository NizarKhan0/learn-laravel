@extends('layouts.mainlayout')

@section('title', 'Extracurricular')

@section('content')
        <h1>This is Extracurricular</h1>

        <div class="my-5">
            <a href="extracurricular-add" class="btn btn-primary">Add Data</a>
        </div>

        @if(Session::has('add'))
            <div class="alert alert-success" role="alert">
                {{Session::get('message')}}
            </div>
        @endif

        <h2>Extracurricular List</h2>


        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ekskulList as $data)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$data->name}}</td>
                    <td><a href="extracurricular-detail/{{$data->id}}">Detail</a></td>
                <td>
                @endforeach
            </tbody>
        </table>
@endsection

