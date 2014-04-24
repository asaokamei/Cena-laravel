<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::pattern( 'id', '[0-9]+' );

Route::get('/', 'Blog\Controller\PostController@listPost' );

Route::get('/{id}', 'Blog\Controller\PostController@onGet' );

Route::post('/{id}', 'Blog\Controller\PostController@onAddComment' );

Route::get('/{id}/edit', 'Blog\Controller\PostController@onEdit' );

Route::post('/{id}/edit', 'Blog\Controller\PostController@onPut' );

Route::get('/{id}/create', 'Blog\Controller\PostController@onNew' );

Route::post('/{id}/create', 'Blog\Controller\PostController@onCreate' );