<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table= 'comments';
    protected $fillable = [
        'post_id',
        'parent_comment_id',
        'body'
    ];

    protected $appends = ['comments'];

    public function getCommentsAttribute(){
        return $this->hasMany('App\Comment','parent_comment_id' ,'id')
        ->orderBy('created_at','asc')->get();
    }
}
