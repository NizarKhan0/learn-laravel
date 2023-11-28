@extends('layouts.mainlayout')

@section('title', 'Add New Class')

@section('content')

    <div class="mt-5 col-8 m-auto">
        <form action="class" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="mb-3">
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection
