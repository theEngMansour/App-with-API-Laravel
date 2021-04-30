
@extends('posts.layout')
@extends('layouts.app')
@section('content')
  @if (count($posts))
    @foreach ($posts as $post) 
      <div class="blog-post bg-white py-4 px-4">
        <h2 style="font-family: 'Cairo', sans-serif;" class="blog-post-title">{{$post->title}}</h2>
        <div style="color:#2285c8;font-weight: 700" href="#">{{$post->user->name}}</div>
        <p class="blog-post-meta">{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</p>
        <p>
          {{$post->excerpt}} 
          <div><a class="btn btn-primary" href="{{route('posts.show',$post['id'])}}">more</a></div>
        </p>
      </div>
    @endforeach
  @else
    <div class="alert alert-success w-100 " role="alert">
      لاتوجد مقالات !!
    </div>
  @endif
  {{$posts->links('pagination::bootstrap-4')}}
@endsection
