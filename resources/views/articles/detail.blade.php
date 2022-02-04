@extends("layouts.app")
@section("content")
    <div class='container'>
      @if(session('info'))
        <div class="alert alert-success">
          {{session('info')}}
        </div>
      @endif
      @if($errors->any())
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      @endif
    <div class='card mb-2'>
        <div class='card-body'>
            <h1 class='card-title'>
                {{$article->title}}
            </h1>
            <div class='card-subtitle mb-2 text-muted small'>
                By <b>{{$article->user->name}}</b>,
                {{$article->created_at->diffForHumans()}}
                 | Category: {{$article->category->name}}
            </div>
            <p class='card-text'>{{$article->body}}</p>
            @if(auth()->check() && auth()->user()->id == $article->user_id)
            <a class='btn btn-warning' href='{{url("/articles/delete/$article->id")}}'>
                Delete
            </a>
            @endif
        </div>
    </div>
    <ul class='list-group'>
      <li class='list-group-item active'>
        @php($cmt_count = count($article->comments))
        {{$cmt_count == 0?'No Comment':($cmt_count>1?$cmt_count.' comments':$cmt_count.' comment')}}
      </li>
      @foreach($article->comments as $comment)
        <li class='list-group-item'>
          {{$comment->content}}
          @if(auth()->check() && auth()->user()->id == $comment->user_id)
            <a href='{{url("/articles/detail/$article->id/comments/delete/$comment->id")}}' class='close'>&times;</a>
          @endif
          <div class="small mt-2">
            By <b>{{$comment->user->name}}</b>,
            {{$comment->created_at->diffForHumans()}}
          </div>
        </li>
      @endforeach
    </ul>
    @auth
    <form class="form" action='{{url("/articles/detail/$article->id/comments/add")}}' method="post">
      @csrf
      <div class="form-group">
        <label for="comment">New Comment</label>
        <input type="text" name="content" class="form-control" value="">
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-success" name="" value="Submit">
      </div>
    </form>
    @endauth
    </div>
@endsection
