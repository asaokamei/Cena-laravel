@extends('layout')

@section('content')

<div class="post col-md-12">
    <h1>{{$post['title']}}</h1>
    <span class="date">[{{ $post['publishAt'] }}] [
        @foreach( $tags as $tag )
        {{ $tag->tag }}
        @endforeach
    ]</span>
    <div class="content">{{ $post['content'] }}</div>

</div>

<div class="post col-md-8">
    <h2>Comments</h2>
    @foreach( $comments as $comment )
    <div class="comments">
        <span class="date">{{{$comment['created_at']}}}</span>
        {{{$comment['comment']}}}
    </div>
    @endforeach
    <div class="comments">
        {{ Form::open() }}
        <span class="date">Leave a New Comment Here!</span>
        <input type="hidden" name="{{ $post_form_name }}[link][comments]" value="Cena.comment.0.1" />
        <textarea name="Cena[comment][0][1][prop][comment]" rows="5" ></textarea>
        <button type="submit" class="btn btn-info">add comment</button>
        {{ Form::close() }}
    </div>
</div>
@stop