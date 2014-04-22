<?php

use Cena\Cena\CenaManager;
use Cena\Cena\Factory as CenaFactory;
use Cena\Cena\Process;
use Cena\Eloquent\Factory;
use Illuminate\Database\Eloquent\Collection;

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

        $formP = CenaFactory::buildHtmlForms();
        $formP->setEntity($post);
        return View::make('post-view')
            ->with( 'post', $formP )
            ->with( 'message',   Session::get( 'message', '' ) )
            ->with( 'alertType', Session::get( 'alertType', 'alert-info' ) )
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
            Session::flash( 'alertType', 'alert-danger' );
            return Response::make( '', 302 )->header( 'Location', $url );
        }
        if( !$this->cm->fetch('comment.0.1')->comment ) {
            Session::flash( 'message', 'please write something in the comment.' );
            Session::flash( 'alertType', 'alert-danger' );
            return Response::make( '', 302 )->header( 'Location', $url );
        }
        $this->cm->save();
        return Response::make( 'saved a new comment', 302 )->header( 'Location', $url );
    }

    /**
     * get the details of a blog post, $id.
     * read post, comments, and tags from db.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function onEdit($id)
    {
        $this->setCena();

        /** @var Post $post */
        $post = $this->cm->getEntity( 'post', $id );
        $post['publishAt'] = (new DateTime($post['publishAt']))->format("Y-m-d\TH:i:s");
        $allTags = \Tag::all();

        $formP = CenaFactory::buildHtmlForms();
        $formP->setEntity($post);
        return View::make('post-edit')
            ->with( 'post', $formP )
            ->with( 'tags', $allTags )
            ->with( 'form', CenaFactory::buildHtmlForms() )
            ->with( 'message',   Session::get( 'message', '' ) )
            ->with( 'alertType', Session::get( 'alertType', 'alert-info' ) )
            ;
    }
    
    function onPut($id)
    {
        $this->setCena();

        /** @var Post $post */
        DB::beginTransaction();
        
        $post = $this->cm->getEntity( 'post', $id );
        $post->tags()->detach();
        $this->process->setSource( $_POST );
        
        if( $this->process->process() ) {
            $this->cm->save();
            DB::commit();
            Session::flash( 'message', 'updated the post' );
            return Response::make( '', 302 )->header( 'Location', url( "/{$id}" ) );
        }
        DB::rollBack();
        
        $formP = CenaFactory::buildHtmlForms();
        $formP->setEntity($post);
        $allTags = \Tag::all();
        return View::make('post-edit')
            ->with( 'post', $formP )
            ->with( 'tags', $allTags )
            ->with( 'form', CenaFactory::buildHtmlForms() )
            ->with( 'message', 'update failed. please check the input!' )
            ->with( 'alertType', 'alert-danger' )
            ;
    }
}