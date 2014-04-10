<?php

class PostController extends BaseController {

    public function listPost()
    {
        $posts = Post::all();
        return View::make('post-index')->with( 'posts', $posts );
    }

    public function onGet($id)
    {
        $post = Post::find($id);
        return View::make('post-view')->with( 'post', $post );
    }
}