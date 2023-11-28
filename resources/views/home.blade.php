@extends('layouts.mainlayout')

@section('title', 'Home')

@section('content')
        <h1>Home Page</h1>
        <h2>Welcome, {{Auth::user()->name}}. Your Are {{Auth::user()->role->name}}</h2>

        <x-alert message='ini adalah home page' type='success'/>

        {{-- <table class="table">
            <tr>
                <th>No.</th>
                <th>Nama</th>
            </tr>
            @foreach($buah as $data)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data}}</td>
            </tr>
            @endforeach
        </table> --}}
                {{-- @if ($role == 'admin')
        <a href="">to admin page</a>
        @elseif ($role == 'staff')
        <a href=""> to gudang</a>
        @else
        <a href="">Whatever</a>
        @endif --}}

        {{-- @switch($role)
            @case($role=='admin')
            <a href="">admin page</a>
            @break

            @case($role=='staff')
            <a href="">staff page</a>
            @break

            @default
            <a href="">random page</a>
        @endswitch --}}

        {{-- @for($i = 0; $i < 5; $i++)
            {{$i}} <br>
        @endfor --}}

        {{-- @foreach($buah as $data)
        {{$data}}<br>
        @endforeach --}}

@endsection
