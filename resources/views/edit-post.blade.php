@extends('layouts.app')

@section('title','My Posts Page')

@section('content')
<h1>Edit Page</h1>

@if (session()->has('message'))
   <h3> {{session('message')}} </h3>
@endif 


<form class="form-control" action="{{route('updatePost',['id' => $post->id])}}" method="post" enctype="multipart/form-data" >
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Post Title</label>
        <input value="{{$post->title}}" type="text" name="title" class="form-control" id="title">
    </div>
    @error('title')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror
    <div class="mb-3">
        <label for="body" class="form-label">Post Body</label>
        <textarea name="body" class="form-control" id="body" rows="3"> {{$post->body}} </textarea>
    </div>
    @error('body')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror
    <div class="mb-3">
        <input class=" form-control" type="file" name="image" id="">
    </div>
    @error('image')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror
    <div class=" text-end">
        <button class="btn btn-dark" type="submit">Confrim</button>
    </div>
</form>


@endsection