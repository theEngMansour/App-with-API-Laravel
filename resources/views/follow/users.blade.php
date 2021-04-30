@extends('posts.layout')
@section('content')

<div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        <table class="table  bg-white border">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Time</th>
              <th scope="col">Email</th>
              <th scope="col">Follower</th>
            </tr>
          </thead>
          <tbody>
            @Foreach($users as $user)
            <tr>
              <th scope="row">{{$user->id}}</th>
              <td>{{$user->name}}</td>
              <td>{{$user->created_at}}</td>
              <td>{{$user->email}}</td>
              <td>
                <form action="{{route('follow.store')}}" method="POST">
                  {{ csrf_field() }}
                  <input type="hidden" name="to_user_id" value="{{$user->id}}">
                  <input type="submit" class="btn btn-outline-success" value="إرسال الطلب">
                </form>
              </td>
            </tr>
            @endforeach
        
          </tbody>
        </table>
        <div class="col-md-6">
          <div class="my-3 p-3 bg-white rounded box-shadow" style="direction:  rtl;text-align:  right;">
            <h6 class="border-bottom border-gray pb-2 mb-0">الطلبات المرسلة</h6>
            @foreach ($requests as $request)
           
              <div class="media text-muted pt-3">
                <img src="" alt="" class="col-sm-2 mr-2 rounded" style="margin-right: -3%;width: 50px;height: 50px;">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
                  <div class="d-flex justify-content-between align-items-center w-100">
                    <strong style="color: black" class="text-gray-dark">{{$request->to_user->name}}</strong>
                    <form method="post" action="{{route('follow.destroy', $request['id'])}}">
                      {{ csrf_field() }}
                        <input type="submit" name="" class="btn btn-outline-warning" value="حذف الطلب" >
                        <input name="_method" type="hidden" value="DELETE">
                      </form> 
                  </div>
                  <?php $request->created_at = strtotime('created_at');?>
                  <span style="color: black"  class="d-block">تم إرساله بتاريخ {{date('m-d-Y')}}</span>
                </div>
              </div>
            @endforeach
            <small class="d-block text-right mt-3">
              <a href="#">جميع التحديثات</a>
            </small>
          </div>
        </div> 
      </div>
    </div>
  </div>

  @endsection
