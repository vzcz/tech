@extends('layouts.app')

@section('content')
    <style>
        body{
            background: url("../../images/17973908.jpg") !important;
        }
    </style>
    @if(session()->has("success"))
        <div class="alert alert-success">{{session()->get('success')}}</div>
    @endif

    @if(session()->has("error"))
        <div class="alert alert-danger">{{session()->get('error')}}</div>
    @endif
    <table class="table table-dark">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Country</th>
            @can("edit employee")
            <th>Operation</th>
            @endcan

        </tr>
        </thead>
        <tbody>
        @foreach($employees as $employee)
        <tr>
            <th scope="row">{{$employee->id}}</th>
            <td>{{$employee->name}}</td>
            <td>{{$employee->age}}</td>
            <td>{{$employee->Country}}</td>
                @can("edit employee")
            <td><a href="{{route("employee.edit", $employee->id)}}" class="btn btn-primary">Edit</a>
                @endif
                &nbsp;@can("delete employee")
                <a href="{{route("employee.delete", $employee->id)}}" class="btn btn-danger">Delete</a></td>
                @endcan
        </tr>
        @endforeach
        </tbody>
    </table>
    @can("create employee")
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <a href="{{route("add.employee")}}" class="btn btn-default">Add User</a>

            </div>
        </div>
    </div>
    @endcan

@endsection
