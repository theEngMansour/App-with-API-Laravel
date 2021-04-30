<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follower;
class followController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $follow_requests=Follower::with('from_user')->where(['to_user_id'=>auth()->user()->id,"accepted"=>0])->get();
        //$followers=Follower::with('from_user','to_user')->
        //                where(["to_user_id"=>auth()->user()->id,"accepted"=>1])->
        //                orWhereRaw("from_user_id = ? AND accepted = ?", [auth()->user()->id,1])
        //                ->get();
        $followers = Follower::where(['to_user_id'=>auth()->user()->id,'accepted'=>1])
                                    ->orwhereRaw("from_user_id=? AND accepted=?" ,[auth()->user()->id,1])
                                    ->get();
        return view('follow/followers', compact('follow_requests','followers'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $is_follower = Follower::where(["from_user_id"=>auth()->user()->id,"to_user_id"=>$request->get('to_user_id')]);
        
        if($is_follower->count()==0){
            $follower = new Follower;
            $follower->to_user_id=$request->get('to_user_id');
            $follower->from_user_id=auth()->user()->id;
            $follower->accepted=0;
            $follower->save();
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $follow= Follower::find($id);
        $follow->accepted = 1;
        $follow->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $follower =Follower::find($id);
        $follower->delete();
        return back();
    }
}
