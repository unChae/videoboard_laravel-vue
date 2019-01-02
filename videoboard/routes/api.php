<?php

/*
|--------------------------------------------------------------------------
| api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return 'Hello world!';
});

$router->post('/posts/create', 'PostsController@createPost');
$router->get('/posts','PostsController@getPosts');

$router->post('/comments/create', 'CommentsController@createComment');
$router->get('/comments/{post_id}','CommentsController@getComments');
