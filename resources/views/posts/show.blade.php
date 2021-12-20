@extends('layouts.app')

@section('title', 'Show Posts')

@section('content')
<h1>A post</h1>

@if ($post['isNew'])
    <p>Nuevo post</p>
@elseif(!$post['isNew'])
    <p>No es un nuevo post</p>
@endif


<div>
    <p>{{ $post['title'] }}</p>
    <p>{{ $post['content'] }}</p>
</div>
@endsection