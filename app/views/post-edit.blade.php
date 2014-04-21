@extends('layout')

@section('content')

<div class="post col-md-12">
    {{ Form::open() }}

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

        <dt>Tags:</dt>
        <dd>
            @foreach( $post->get('tags') as $tag )
            {{ $tag->tag }}
            @endforeach
        </dd>

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

    {{ link_to( "/{$post->getKey()}/edit", 'update post', array('class'=>'btn btn-primary') ) }}
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
    {{ link_to( "/{$post->getKey()}/edit", 'update post', array('class'=>'btn btn-primary') ) }}
    {{ Form::close() }}
</div>
@stop