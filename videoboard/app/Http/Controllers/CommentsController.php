<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller{

    public function createComment(Request $request){
        try{
            $this->validate($request, [
                'post_id' => 'required|exists:posts,id',
                'parent_comment_id' => 'exists:comments,id,post_id,' . $request->input('post_id'),
                'body' => 'required|min:10|max:1000'
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }

        $comment = Comment::create([
            'post_id' => $request->input('post_id'),
            'parent_comment_id' => $request->input('parent_comment_id'),
            'body' => $request->input('body')
        ]);

        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);
    }

    public function getComments($post_id){
        $post = Post::where('id',$post_id)->with(['comments' => function($query){
            $query->whereNull('parent_comment_id')->orderBy('created_at','asc');
        }])->first();

        return response()->json([
            'success' => true,
            'post' => $post,
        ]);
    }
}