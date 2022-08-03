@extends('layouts.app')

@section('content')
    @if(session()->has("success"))
        <div class="alert alert-success">{{session()->get('success')}}</div>
    @endif
    @if(session()->has("error"))
        <div class="alert alert-danger">{{session()->get('error')}}</div>
    @endif
    @can('create employee')
    <div class="mb-3">
        <form action="{{route('employee.store.file')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="formFile" class="form-label">Upload file</label>
            <input class="form-control" type="file" name="file" id="formFile">
            <input type="hidden" name="id" value="{{$employees->id}}">
            <input type="submit" value="upload">
        </form>
    @endcan
    </div>
    <div class="row">
    @foreach($employees->file as $employee)
            <p hidden>{{$mimeType = mime_content_type($employee->name)}}</p>
        @if($mimeType == "image/jpeg" || $mimeType == "image/png" || $mimeType == "image/jpg"|| $mimeType == "image/gif")
            <div class="col-sm-6">
                <div class="card" style="height: 150px;width: 600px; margin: 5px">
                    <div class="card-body">
                        <h5 class="card-title">Image</h5>
                            <img class="card-img-top" src="{{url($employee->name)}}" width="50" height="50" style="object-fit: cover;">
                        <a href="{{url($employee->name)}}" class="btn btn-primary m-1">View</a>
                    </div>
                </div>
            </div>
            @endif
            @if($mimeType == "application/pdf" || $mimeType == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
            <div class="col-sm-6">
                <div class="card" style="height: 150px;width: 600px; margin: 5px">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title" >Document</h5>
                        </div>
                        <a href="{{url($employee->name)}}" class="btn btn-primary mt-5">Download</a>
                    </div>
                </div>
            </div>
            @endif
    @endforeach
    </div>

@endsection

