<?php

namespace App\Http\Controllers;
use App\Unlike;
use Illuminate\Http\Request;

class UnlikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $is_Unlike = Unlike::where(["user_id"=>auth()->user()->id,"post_id"=>$request->get('post_id')]);
        if($is_Unlike->count()==0){
            $Unlike= new Unlike();
            $Unlike->post_id=$request->get('post_id');
            $Unlike->user_id=auth()->user()->id;
            $Unlike->save();
        }
        return redirect()->back();
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        //
        $Unlike = Unlike::where(["user_id"=>auth()->user()->id,"post_id"=>$post_id]);
        $Unlike->delete();
        $count_unlike = Unlike::where('post_id',$post_id )->count();
        return redirect()->back();
    }
}
