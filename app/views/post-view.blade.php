@extends('layout')

@section('content')

<div class="post col-md-12">

    <h1>{{ $post->title }}</h1>
    <span class="date">{{ $post->publishAt }}</span>
    <div class="content">{{ $post->content }}</div>

</div>

@stop