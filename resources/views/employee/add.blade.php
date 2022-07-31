@extends('layouts.app')

@section('content')
    <style>#cover {
            background-size: cover;
            height: 100%;
            text-align: center;
            display: flex;
            align-items: center;
            position: relative;
        }

        #cover-caption {
            width: 100%;
            position: relative;
            z-index: 1;
        }

        /* only used for background overlay not needed for centering */
        form:before {
            content: '';
            height: 100%;
            left: 0;
            position: absolute;
            top: 0;
            width: 100%;
            background-color: rgba(0,0,0,0.3);
            z-index: -1;
            border-radius: 10px;
        }
    </style>
    <section id="cover" class="min-vh-100">
        <div id="cover-caption">
            <div class="container">
                <div class="row text-white">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                        <div class="px-2">
                            @if(session()->has("success"))
                            <div class="alert alert-success">{{session()->get('success')}}</div>
                            @endif
                            <form action="{{route("store.employee")}}" method="post" class="justify-content-center" style="color:#000">
                                @csrf
                                <div class="form-group">
                                    <label class="sr-only">Name</label>
                                    <input name="name" type="text" class="form-control">
                                    @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Age</label>
                                    <input name="age" type="text" class="form-control">
                                    @error('age')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Country</label>
                                    <input name="country" type="text" class="form-control">
                                    @error('country')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-info btn-lg" style="margin-top: 20px">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

