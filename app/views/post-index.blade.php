@extends('layout')

@section('content')

<div class="jumbotron">
    <div class="container">
        <h1>Cena on Laravel Framework!</h1>
        <p>This is a demo blog for Cena technology using Laravel and Eloquent ORM.<br/>
            Try edit one of the posts to see how Cena works. </p>
        <p><a href="https://github.com/asaokamei/Cena-demo" class="btn btn-primary btn-lg" role="button" target="_blank">See it on the github »</a></p>
    </div>
</div>

<div class="post col-md-12">

    @foreach( $posts as $post )

    <div class="col-md-4">

        <h2>{{ link_to( '/'.$post->post_id, $post->title ) }}</h2>
        <span class="date">{{ $post->publishAt }}</span>
        <span>{{ $post->content }}</span>
    </div>

    @endforeach

</div>

@stop