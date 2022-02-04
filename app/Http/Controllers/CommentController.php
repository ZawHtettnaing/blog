<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Comment;
class CommentController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
  public function create($article_id){
    $validator = validator(request()->all(),[
      'content'=>'required'
    ]);
    if($validator->fails()){
      return back()->withErrors($validator);
    }
    $comment = new Comment;
    $comment->content = request()->content;
    $comment->article_id = $article_id;
    $comment->user_id = auth()->user()->id;
    $comment->save();

    return redirect("/articles/detail/$article_id");
  }

  public function delete($article_id,$comment_id){
    $comment = Comment::find($comment_id);
    if(Gate::allows('comment-delete',$comment)){
      $comment->delete();
      return back()->with('info','Comment Deleted');
    }else{
      abort(403);
    }

  }
    //
}
