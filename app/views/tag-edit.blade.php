@extends('layout')

@section('content')

<div class="post col-md-12">

    <h1>Edit Tag: #{{ $tag->tag_id }}</h1>

    <p>update tag: {{ $tag->tag }}</p>

    {{ Form::open( array( 'method' => 'put' ) ) }}

    <label for="tag">
        Tag:
    </label>

    {{ Form::text( 'tag', $tag->tag ) }}
    {{ ($msg = $errors->first('tag')) ? "<span class=\"error-msg\" >{$msg}</span><br/>":''; }}

    <button type="submit" class="btn btn-primary">Update Tag</button>

    {{ Form::close() }}


    <h2>Delete This Tag</h2>

    <p>To delete this tag, click the large danger button below...</p>

    {{ Form::open( array( 'method' => 'delete' ) ) }}

    <br/>
    <button type="submit" class="btn btn-danger">Delete This Tag</button>

    {{ Form::close() }}
</div>

@stop