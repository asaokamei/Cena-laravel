@extends('layout')

@section('content')

<div class="post col-md-12">

    <h1>Tag List</h1>

    <ul>

        @foreach( $tags as $tag )

        <li>{{ link_to( '/tag/'.$tag->tag_id, $tag->tag ) }}</li>

        @endforeach

    </ul>

    <h2>New Tag</h2>

    <p>add a new tag using form below.</p>

    {{ Form::open( array( 'url' => url("/tag/"), 'method'=>'post' ) ) }}

    <label for="tag">
        New Tag:
    </label>

    {{ Form::text( 'tag' ) }}
    {{ ($msg = $errors->first('tag')) ? "<span class=\"error-msg\" >{$msg}</span><br/>":''; }}
    <button type="submit" class="btn btn-primary">Create A New Tag</button>


    {{ Form::close() }}

</div>

@stop