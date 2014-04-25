<?php
namespace Blog\Controller;

use Blog\Model\Tag;
use Input;
use Redirect;
use Response;
use Validator;
use View;

class TagController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $tags = Tag::all();
        return View::make('tag-index')->with( 'tags', $tags );
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return $this->index();
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $input = Input::all();
        $validator = Validator::make(
            $input,
            array(
                'tag' => 'required',
            )
        );
        if( $validator->passes() ) {
            Tag::create( $input );
            $url = url( "/tag/" );
            return Response::make( '', 302 )->header( 'Location', $url );
        }
        return Redirect::to( url( "/tag/" ))
            ->withErrors( $validator )
            ;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return $this->edit($id);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $tag = Tag::find($id);
        return View::make('tag-edit')->with( 'tag', $tag );
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
        $tag = Tag::find($id);
        $input = Input::all();
        $validator = Validator::make(
            $input,
            array(
                'tag' => 'required',
            )
        );
        if( $validator->passes() ) {
            $tag->fill( $input );
            $tag->save();
            $url = url( "/tag/" );
            return Response::make( '', 302 )->header( 'Location', $url );
        }
        return Redirect::to( url( "/tag/{$id}" ))
            ->withErrors( $validator )
            ;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$tag = Tag::find($id);
        $tag->delete();
        $url = url( "/tag/" );
        return Response::make( '', 302 )->header( 'Location', $url );
	}


}
