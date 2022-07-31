@extends('layouts.app')

@section('content')
    <table class="table table-dark">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Country</th>
            <th>Operation</th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees as $employee)
        <tr>
            <th scope="row">{{$employee->id}}</th>
            <td>{{$employee->name}}</td>
            <td>{{$employee->age}}</td>
            <td>{{$employee->Country}}</td>
            <td><a href="#" class="btn btn-primary">Edit</a>
                &nbsp;
                <a href="#" class="btn btn-danger">Delete</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <a href="{{route("add.employee")}}" class="btn btn-default">Add User</a>
            </div>
        </div>
    </div>

@endsection
