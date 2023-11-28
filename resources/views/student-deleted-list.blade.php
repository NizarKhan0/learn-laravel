@extends('layouts.mainlayout')

@section('title', 'Students')

@section('content')

<h1>
    List Deleted Student
</h1>
        <div class="my-5">
            <a href="/students" class="btn btn-primary">Back</a>
        </div>

        <div class="mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Student ID</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            @foreach ($student as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->gender}}</td>
                                <td>{{$data->studid}}</td>
                                <td>
                                    <a href="/student/{{$data->slug}}/restore">Restore</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </thead>
                </table>
        </div>
@endsection
