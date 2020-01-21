<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 6/12/2018
 * Time: 12:33 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pizo\Users\Models\Users;

class UsersController extends Controller
{
    /**
     * UsersController constructor
     */
    public function __construct()
    {
        $this->middleware(['jwt.auth','admin']);
    }


    /** get all users
     * @return mixed
     */
    public function all(){
        return Users::where('deleted',0)
            ->paginate(10);
    }

    /** get user by group
     * @param $cid
     * @return mixed
     */
    public function getbygroup($cid){
        return Users::where('group',$cid)
            ->where('deleted',0)
            ->paginate(10);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){

        $user = Users::find($id);
        if(!$user) {
            return response()->json(['msg' => 'not found', 'error' => 1], 404);
        }

        $user->deleted = 1;
        $user->save();
        return response()->json(['msg'=>'User Deleted','error'=>0],200);


    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate($id){

        $user = Users::find($id);
        if(!$user) {
            return response()->json(['msg' => 'not found', 'error' => 1], 404);
        }

        $user->status = 1;
        $user->save();
        return response()->json(['msg'=>'User activated','error'=>0],200);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivate($id){

        $user = Users::find($id);
        if(!$user) {
            return response()->json(['msg' => 'not found', 'error' => 1], 404);
        }

        $user->status = 0;
        $user->save();
        return response()->json(['msg'=>'User deactivated','error'=>0],200);
    }

}