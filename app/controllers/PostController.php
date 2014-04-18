<?php

use Cena\Cena\CenaManager;
use Cena\Cena\Factory as CenaFactory;
use Cena\Eloquent\Factory;

class PostController extends BaseController {

    /**
     * @var CenaManager
     */
    protected $cm;

    protected function setCena()
    {
        $ema       = Factory::getEmaEloquent();
        $this->cm  = CenaFactory::getCenaManager( $ema );
    }

    public function listPost()
    {
        $posts = PostView::all();
        return View::make('post-index')->with( 'posts', $posts );
    }

    public function onGet($id)
    {
        $this->setCena();

        $post = Post::find($id);
        $tags = $post->tags;
        $comments = $post->comments;

        $formP = CenaFactory::buildHtmlForms();
        $formP->setEntity($post);
        $formP->getFormName();
        return View::make('post-view')
            ->with( 'post', $formP )
            ->with( 'tags', $tags )
            ->with( 'comments', $comments )
            ->with( 'post_form_name', $formP->getFormName() )
            ;
    }
}