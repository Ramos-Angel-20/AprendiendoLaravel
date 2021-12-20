@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <h1>All available posts</h1>

    @foreach ($posts as $key => $post)
        <div>
            <p>{{$key}} {{$post['title']}}</p>
            <p>{{$post['content']}}</p>
        </div>
    @endforeach
@endsection