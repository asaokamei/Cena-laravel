@extends('layout')

@section('content')

<div class="post col-md-12">
    
    @if( $message )
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Error:</strong><br/>
        {{ nl2br( $message ) }}
    </div>    
    @endif
    
    <h1>{{ $post['title'] }}</h1>
    
    <span class="date">[{{ $post['publishAt'] }}] [
        @foreach( $post->get('tags') as $tag )
        {{ $tag->tag }}
        @endforeach
    ]</span>
    
    <div class="content">{{ nl2br( $post['content'] ) }}</div>

    <p style="float: right;">
        {{ link_to( "/{$post->getKey()}/edit", 'edit post', array('class'=>'btn btn-primary') ) }}
    </p>

</div>

<div class="post col-md-8">
    
    <h2>Comments</h2>
    
    @foreach( $post->get('comments') as $comment )
    <div class="comments">
        <span class="date">{{{$comment['created_at']}}}</span>
        {{ nl2br( e($comment['comment'] ) ) }}
    </div>
    @endforeach
    
    <div class="comments">
        {{ Form::open() }}
        <span class="date">Leave a New Comment Here!</span>
        <input type="hidden" name="Cena[comment][0][1][link][post]" value="{{ $post->getCenaId() }}" />
        <textarea name="Cena[comment][0][1][prop][comment]" rows="5" ></textarea>
        <button type="submit" class="btn btn-info">add comment</button>
        {{ Form::close() }}
    </div>
    
</div>
<div style="clear: both;"></div>

@stop