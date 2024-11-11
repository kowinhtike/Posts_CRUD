@extends('layouts.app')

@section('title', 'My Post Page')

@section('content')


    @if (session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
          </div>
    @endif

    <h1>{{ $post->title }}</h1>
    <p> {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y \a\t g:i A') }}
    </p>
    <p> {{$post->body}} </p>
    {{-- <p>
        {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}

    </p> --}}
    <img class="mb-3" src="{{asset('storage/'.$post->url)}}"  alt="{{ $post->title }}">
    <div class=" d-flex gap-3">
        <a class="btn btn-secondary" href="{{ route('editPost', ['id' => $post->id]) }}">Edit</a>
        <form action="{{ route('removePost', ['id' => $post->id]) }}" method="post">
            @csrf
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
    </div>
    
@endsection
