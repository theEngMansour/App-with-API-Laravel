@extends('posts.layout')
@extends('layouts.app')
@section('content')
  @if (count($errors))
    <div class="alert alert-danger" >
      @foreach ($errors->all() as $error)
          <p>{{$error}}</p>
      @endforeach
    </div>
  @endif
  {{-- body --}}
  <div class="blog-post bg-white py-4 px-4">
    <h2 style="font-family: 'Cairo', sans-serif;" class="blog-post-title">{{$post->title}}</h2>
    <div style="color:#2285c8;font-weight: 700" href="#">{{$post->user->name}}</div>
    {{$post->created_at = strtotime('created_at')}} 
    <p style="font-weight:bold;font-size:12px" class="blog-post-meta">{{ date('Y-m-d')}}</p>
    <p>
      {{$post->body}} 
    </p>
    <div class="progress">
     </div>
    {{-- Like --}}
    @if (Auth::check())
      <div class="mt-4 w-100 ">
        <a id="count_id" style="background-color: #2285c8;color:#fff;" class="btn btn-sm">{{$count}}</a>
        <button style="background-color: #2285c8;color:#fff;" class="btn btn-sm  mx-2" id="btn_value_id" onclick="like_action()">Like</button>
      </div> 
      {{-- UnLike : بطريقة أخرئ --}}
      @if (sizeof($user_unlike)==1)
        <form action="{{route('unlike.destroy',$post['id'])}}" method="POST" class="mt-2 w-100 ">
          {{csrf_field()}}
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="post_id" value="{{$post->id}}">
          <a style="border-color: #c8222a;color:#c8222a;" class="btn btn-sm">{{$count_unlike}}</a>
          <button style="border-color: #c8222a;color:#c8222a;" class="btn btn-sm mx-2" >Chencal : Not Good </button>
        </form>      
      @else
        <form action="{{route('unlike.store')}}" method="POST" class="mt-2 w-100 ">
          {{csrf_field()}}
          <input type="hidden" name="post_id" value="{{$post->id}}">
          <a style="background-color: #c8222a;color:#fff;" class="btn btn-sm">{{$count_unlike}}</a>
          <button style="background-color: #c8222a;color:#fff;" class="btn btn-sm  mx-2">Not Good</button>
        </form> 
      @endif
      {{--End Code UnLike : بطريقة أخرئ --}}
    @endif
  </div>
  {{-- comments --}}
  <ul class="list-group list-group-flush my-4">
    @foreach ($post->comments as $comment)
      <li class="list-group-item">
        <p style="margin:0;font-weight:bold">{{$comment->user->name}}</p>
        <p style="margin:0;font-weight:400;color:#2285c8">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</p>
        {{$comment->comment}}

          @can('delete', $comment)
            <form action="{{route('comments.destroy',$comment['id'])}}" method="POST">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <div><button type="submit" style="background-color: #c8222a;color:#fff;" class="btn btn-sm my-4">Delete</button></div>
            </form>
          @endcan

      </li>
    @endforeach
    {{-- Add Comment --}}
    <div class="list-group-item">
      <label for="exampleFormControlTextarea1">Add New Comment</label>
      <form action="{{route('comments.store')}}" method="POST">
        {{ csrf_field() }}
        <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        <input type="hidden" name="post_id" value="{{$post['id']}}">
        <button type="submit" style="background-color: #2285c8;color:#fff;" class="btn btn-sm my-4 w-50">Add Comment</button>
      </form>
    </div>
  </ul>
{{-- Script Like --}}
<script src = "{{ asset('js/app.js') }}"> </script>
<script src = "{{ asset('js/jquery-3.3.1.min.js') }}"> </script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
  var like= "Like";
  var unlike= "Unlik";
  var token = '{{csrf_token()}}';
  var post_id ="{{$post['id']}}";
  var like_id = 0;
  @if(sizeof($userLike)==1)
  like_id = "{{$userLike[0]->id}}";
  $('#btn_value_id').html(unlike);
  @endif
  function like_action(){
  if(like_id == 0){
  $.ajax({
      type: "POST",
      url: "{{ url('like') }}",
      data: {post_id: post_id, _token: token},
      success: function( msg ) {
          $('#count_id').html(msg.count);
          $('#btn_value_id').html(unlike);
          like_id = msg.id;
      }
  });
  }
  else{
  $.ajax({
      type: "POST",
      url: "{{ url('like') }}/"+post_id,
      data: {post_id: post_id, _token: token, _method:"DELETE"},
      success: function( msg ) {
          $('#count_id').html(msg.count);
          $('#btn_value_id').html(like);
          like_id =0;
      }
  });
  }
  }
</script>
@endsection

{{-- @if (Auth::check())
@if (sizeof($userLike)==1)
  <form action="{{route('like.destroy',$post['id'])}}" method="POST" class="mt-4 w-100 ">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <a id="count_id" style="border-color: #2285c8;color:#2285c8;" class="btn btn-sm">{{$count}}</a>
    <button style="border-color: #2285c8;color:#2285c8;" class="btn btn-sm mx-2" id="btn_value_id" >إلغاء الاعجاب</button>
  </form>      
@else
    <form action="{{route('like.store')}}" method="POST" class="mt-4 w-100 ">
      {{csrf_field()}}
      <input type="hidden" name="post_id" value="{{$post->id}}">
      <a id="count_id" style="background-color: #2285c8;color:#fff;" class="btn btn-sm">{{$count}}</a>
      <button style="background-color: #2285c8;color:#fff;" class="btn btn-sm  mx-2" id="btn_value_id"> أعجبني </button>
    </form> 
@endif
@endif --}}