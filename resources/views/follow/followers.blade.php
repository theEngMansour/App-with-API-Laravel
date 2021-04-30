@extends('posts.layout')
@section('content')
<div class="col-md-6">
    <div class="my-3 p-3 bg-white rounded box-shadow" style="direction:  rtl;text-align:  right;">
      <h6 class="border-bottom border-gray pb-2 mb-0">الطلبات المرسلة</h6>
      <!-- Foreach Follow Requset  -->
        @Foreach($follow_requests as $request)
            <div class="media text-muted pt-3">
                <img src="" alt="" class="col-sm-2 mr-2 rounded" style="margin-right: -3%;width: 50px;height: 40px;margin-top:  -1%;">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong style="color: black" class="text-gray-dark">{{$request->from_user->name}}</strong>
                    <form method="post" action="{{route('follow.update', $request['id'])}}">
                        {{ csrf_field() }}
                        <div>
                          <input type="submit" class=" mr-4 btn btn-outline-success" value="قبول الطلب">
                          <input name="_method" type="hidden" value="PATCH">
                        </div>
                    </form>
                </div>
                <span style="color: black" class="d-block">{{$request->from_user->created_at}}</span>
                </div>
            </div>
        @endforeach
      <!-- End Foreach Follow Requset  -->
      <small class="d-block text-right mt-3">
        <a href="#">جميع التحديثات</a>
      </small>
    </div>
  </div>
  <div class="col-md-6">
    <div class="my-3 p-3 bg-white rounded box-shadow" style="direction:  rtl;text-align:  right;">
      <h6 class="border-bottom border-gray pb-2 mb-0">الأصدقاء</h6>
        @foreach ($followers as $follower)
        @php
          $user = $follower->from_user->id == auth()->user()->id ? $follower->to_user : $follower->from_user;
        @endphp
      <div class="media text-muted pt-3">
        <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
          <div class="d-flex justify-content-between align-items-center w-100">
            <a href="{{url('user/'.$user->id.'/posts')}}"><strong class="text-gray-dark">{{ $user->name}}</strong></a>
            <form method="post" action="{{action('followController@destroy', $follower['id'])}}">
            {{ csrf_field() }}
              <input type="submit" class="btn btn-outline-danger" value="{{ $follower->from_user->id == auth()->user()->id ? 'إلغاء المتابعة' : 'حذفه من المتابعين' }}">
              <input name="_method" type="hidden" value="DELETE">
              <input name="redirect_to" type="hidden" value="user/followers">
            </form>  
          </div>
          <span style="color:black" class="d-block ">{{ $follower->from_user->id == auth()->user()->id ? 'تتابعه ' : 'يتابعك ' }} {{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</span>
        </div>
      </div>
      @endforeach
      <small class="d-block text-right mt-3">
        <a href="#">جميع التحديثات</a>
      </small>
    </div>
  </div>
@endsection