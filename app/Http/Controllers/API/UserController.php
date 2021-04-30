<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\User as UserResource;
class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   //علشان ما يعبث بها مستخدين ويطلبو اكثر من 50 إثناء إدخال قيمة
        $limit = $request->input('limit') <= 50 ? $request->input('limit'): 15;
        return User::paginate($limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //هذي دالة تقبل متغيرين الاول اسم دالة ثاني مصفوفة معاملات يرجى تمريها لدالة 
        $this->authorize('create', User::class );
        $user =new UserResource(User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> Hash::make($request->password)
        ]));
        return $user->response()->setStatusCode('200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return User::with('posts')->find($id);
        return new UserResource(User::find($id));
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
        $iduser = User::findOrFail($id);
        $this->authorize('update', $iduser );
        $user = new UserResource(User::findOrFail($id));
        $user->update($request->all());
        return  $user->response()->setStatusCode(200,"Tag Updated Succefully");
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return 204;
    }
}
