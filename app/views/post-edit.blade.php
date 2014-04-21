@extends('layout')

@section('content')

{{ Form::open() }}

<div class="post col-md-12">

    @if( $message )
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Error:</strong><br/>
        {{ $message }}
    </div>
    @endif

    <h1>Editing Post: #{{$post->getKey()}}</h1>

    <dl>
        <dt>Title:</dt>
        <dd><input type="text" name="{{$post->getFormName()}}[prop][title]" value="{{$post['title']}}" /></dd>

        <dt>Published At:</dt>
        <dd><input type="datetime-local" name="{{$post->getFormName()}}[prop][publishAt]" value="{{$post['publishAt']}}" style="width:20em;" /></dd>

        <dt>Content:</dt>
        <dd><textarea name="{{$post->getFormName()}}[prop][content]" rows="10">{{ $post['content'] }}</textarea></dd>

        <dt>Tags:</dt>
        <dd>
            @foreach( $tags as $tag )
            {{ $form->setEntity( $tag ) }}
            <label>
                {{ Form::checkbox( $post->getFormName().'[link][tags]', $form->getCenaId(), $post->get('tags')->contains($tag->getKey()) ) }}
                <input type="text" name="{{ $form->getFormName() }}[prop][tag]" value="{{ $form['tag'] }}" style="width: 6em" />
            </label>

            @endforeach
        </dd>

    </dl>

    <button type="submit" class="btn btn-primary">update post</button>
</div>

<div class="post col-md-8">
    <h2>Comments</h2>
    @foreach( $post->get('comments') as $comment )
    {{ $form->setEntity( $comment ) }}
    <div class="comments">
        <span class="date">{{{$comment['created_at']}}}</span>
        {{ Form::textarea( $form->getFormName().'[prop][comment]', $comment['comment'], ['rows'=>4] ) }}
    </div>
    @endforeach
    <button type="submit" class="btn btn-primary">update post</button>
</div>

{{ Form::close() }}

@stop