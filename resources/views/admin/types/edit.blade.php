@extends('layouts.admin')


@section('content')

<div class="container">

    <div class="mt-5">Edit Type ID 👉 {{$type->id}}</div>
    <div class="mb-5">Edit Type NAME 👉 {{$type->title}}</div>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li> {{$error}} </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('admin.types.update', $type)}}" method="POST" enctype="multipart/form-data">

        <!-- // Attention to Cross site request forgery attacks -->
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="form-label">NAME ✍</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" value="{{$type->name}}">
            <small id="nameHelper" class="form-text text-muted">Type the name here</small>
            @error('name')
                <div class="text-danger"> {{$message}} </div>
            @enderror
        </div>


        <div>
            <a class="btn btn-success mt-3" href="{{route('admin.types.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg>
            </a>
            <button type="submit" class="btn btn-primary mt-3">
                Update
            </button>
        </div>


    </form>

</div>


@endsection