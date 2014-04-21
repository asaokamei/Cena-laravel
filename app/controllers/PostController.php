<?php

use Cena\Cena\CenaManager;
use Cena\Cena\Factory as CenaFactory;
use Cena\Cena\Process;
use Cena\Eloquent\Factory;

class PostController extends BaseController {

    /**
     * @var CenaManager
     */
    protected $cm;

    /**
     * @var Process
     */
    protected $process;

    /**
     * set up CenaManager and Process. 
     */
    protected function setCena()
    {
        $ema       = Factory::getEmaEloquent();
        $this->cm  = CenaFactory::getCenaManager( $ema );
        $this->cm->setClass( 'Post' );
        $this->cm->setClass( 'Comment' );
        $this->cm->setClass( 'Tag' );
        $this->process = CenaFactory::getProcess();
    }

    /**
     * lists the blog post. 
     * 
     * @return \Illuminate\View\View
     */
    public function listPost()
    {
        $posts = PostView::all();
        return View::make('post-index')->with( 'posts', $posts );
    }

    /**
     * get the details of a blog post, $id. 
     * read post, comments, and tags from db.
     * 
     * @param $id
     * @return \Illuminate\View\View
     */
    public function onGet($id)
    {
        $this->setCena();

        $post = $this->cm->getEntity( 'post', $id );
        $message = Session::get( 'message', '' );

        $formP = CenaFactory::buildHtmlForms();
        $formP->setEntity($post);
        $formP->getFormName();
        return View::make('post-view')
            ->with( 'post', $formP )
            ->with( 'message', $message )
            ;
    }

    /**
     * add an comment for a given post.
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function onAddComment($id)
    {
        $this->setCena();
        $this->cm->getEntity( 'post', $id );

        $this->process->setSource( $_POST );
        $this->process->cleanExcept( 'comment' );
        $url = url( "/{$id}" );
        if( !$this->process->process() ) {
            Session::flash( 'message', 'cannot add a comment' );
            return Response::make( '', 302 )->header( 'Location', $url );
        }
        if( !$this->cm->fetch('comment.0.1')->comment ) {
            Session::flash( 'message', 'please write something in the comment.' );
            return Response::make( '', 302 )->header( 'Location', $url );
        }
        $this->cm->save();
        return Response::make( 'saved a new comment', 302 )->header( 'Location', $url );
    }
}