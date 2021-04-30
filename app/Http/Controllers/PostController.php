<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\Unlike;
use App\Comment;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::paginate(12);
        $archives= $this->getArchives();
        return view('posts.index',compact('posts','archives'));
    }
    /**
     * Search in Posts (title and body)
     *
     * @return \Illuminate\Http\Response
     */

    public function search(request $request)
    {
        $results=array();
        $item= $request->searchname;
        $data=Post::where('title','LIKE','%'.$item.'%')
        ->take(5)->get();
        return response()->json($data);
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
        $post=Post::find($id);
        $archives=$this->getArchives();
        if(Auth::check()){
            $userLike=Like::where(["user_id"=>auth()->user()->id,"post_id"=>$id])->get();
            $count =Like::where('post_id', $id)->count();   //  بوست ايدي حق منشور لايك اذا تطابق مع حق معرف مقالة إذا عمل اعجاب مسبقاً
            $user_unlike=Unlike::where(["user_id"=>auth()->user()->id,"post_id"=>$id])->get();
            $count_unlike =Unlike::where('post_id', $id)->count();   //  بوست ايدي حق منشور لايك اذا تطابق مع حق معرف مقالة إذا عمل اعجاب مسبقاً
        }
        else
        {   
            $userLike=[];
            $count =Like::where('post_id', $id)->count();
            $user_unlike=[];
            $count_unlike =Like::where('post_id', $id)->count();
        }

            return view('posts.show',compact('post','archives','count','userLike','user_unlike','count_unlike'));
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
    public function destroy($id)
    {
        //
    }
    public function archive($year , $month){
        $posts=Post::whereYear('created_at',$year)->whereMonth('created_at',$month)->get();
        $archives= $this->getArchives();
       // return view('posts.layout' ,compact ('posts','archives'));
    }
    
    private function  getArchives(){
        return \App\Post::selectRaw('MONTHNAME(created_at) month , MONTH(created_at) month_number, YEAR(created_at) year, COUNT(*) post_count')->groupBy('month' , 'month_number' ,'year')->orderBy('created_at')->get();
    }
}
