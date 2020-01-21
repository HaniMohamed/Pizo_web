<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 2/6/2018
 * Time: 2:40 PM
 */

namespace App\Pizo\Users\Repositories;


use App\Pizo\Repositories;
use App\Pizo\Users\Models\Users;
use function GuzzleHttp\Psr7\str;
use Illuminate\Database\QueryException;
use League\Flysystem\Exception;

class usersRepositories extends Repositories
{

    /** Save new User
     * @param \stdClass $data
     * @return bool
     */
    public function addNewUser(\stdClass $data){

        // model object
        $user = new Users();

        // set the user data
        // $user->name     = $data->name;
        // $user->username = $data->username;
        $user->email    = $data->email;
        // $user->address  = $data->address;
        $user->city     = 1;
        $user->password = \Hash::make($data->password);
        // $user->phone    = $data->phone;
        $user->group    = $data->group;
        $user->image    = '';
        $user->status   = 1;
        $user->deleted  = 0;

        try{
            //save new user
            $check = $user->save();
            if($check)
                return  true;
            $this->setErrors('can\'t added to DB');
            return false;

        }catch (QueryException $e){
            //Query Exception

            $this->setErrors('add Users QueryException');
            return false;
        }
    }

    /**
     * @param $user
     * @return User | bool
     */
    public function profile($user){
        $client = Users::find($user->id); // get
        return $client;
    }

    /** Get USer co-ordinaries
     * @param $user_id
     * @return array []
     */

    public function getUserLatLng($user_id){

        if(!$user = Users::find($user_id)) {
            $this->getErrors("user not found");
            return [];
        }

        if(!strlen($user->lat)  || !strlen($user->lng) ){
            $this->setErrors("Please, As maintain order owner set good location.");
            return [];
        }

        return [
            "lat"=>$user->lat,
            "lng"=>$user->lng
        ];
    }

    /**
     * @param $lat
     * @param $lng
     * @param int $range
     * @param int $step
     * @param int $group_id
     * @return array|\Illuminate\Database\Query\Builder[]
     */

    public function getUsersOfLatLngRange($lat, $lng, $range = 2,$step = 2, $group_id = 2){



        try {
            $users = \DB::table('users')
                ->select(["users.id"])
                ->where("status", '=', '1')
                ->where("deleted", '=', '0')
                ->where("lat", '>', ($lat - ($range * $step)))
                ->where("lat", '<', ($lat + ($range * $step)))
                ->where("lng", '>', ($lng - ($range * $step)))
                ->where("lng", '<', ($lng + ($range * $step)))
                ->where("group", '=', $group_id)//Default Engineers
                ->get();

            return $users;
        } catch (QueryException $e){
            $this->setErrors("Get Users in Co-or Exception");
            return false;
        }



    }


    /** Update user info
     * @param $id
     * @param $user
     * @return bool
     */
    public function update($id,$data){
        if($client = Users::find($id)){
            // New data
            $client->name       = $data->name;
            $client->email      = $data->email;
            $client->phone      = $data->phone;

            $client->lat        = $data->lat;
            $client->lng        = $data->lng;

            try{
                // Save
                $check = $client->save();
                if ($check)
                    return true;
                $this->setErrors('can\'t added to DB');
                return false;
            }catch (QueryException $e){
                $this->setErrors('update Users QueryException');
                return  false;
            }
        }
        $this->setErrors('Users Not Found  to be update');
        return false;
    }



    /** Reset Password
     * @param $id
     * @param $password
     * @return bool
     */
    public function updatePassword($id,$password){
        if($user = Users::find($id)){
            // New data
            $user->password  = \Hash::make($password);

                try{
                    // Save
                    $check = $user->save();
                    if ($check)
                        return true;

                    $this->setErrors('can\'t added to DB');
                    return false;
                }catch (QueryException $e){
                    $this->setErrors('update Users QueryException');
                    return  false;
                }
            }
        $this->setErrors('Users Not Found  to be update');
        return false;
    }

    /** Set user active
     * @param $id
     * @return bool
     */
    public  function activateUser($id){
        if($user = Users::find($id)){
            // New data
            $user->status  = 1;
            try{
                // Save
                $check = $user->save();
                if ($check)
                    return true;
                $this->setErrors('can\'t added to DB');
                return false;
            }catch (QueryException $e){
                $this->setErrors('update Users QueryException');
                return  false;
            }
        }
        $this->setErrors('Users Not Found  to be update');
        return false;
    }

    /** set user to Deactivate
     * @param $id
     * @return bool
     */
    public  function deactivateUser($id){
        if($user = Users::find($id)){
            // New data
            $user->status  = 0;
            try{
                // Save
                $check = $user->save();
                if ($check)
                    return true;
                $this->setErrors('can\'t added to DB');
                return false;
            }catch (QueryException $e){
                $this->setErrors('update Users QueryException');
                return  false;
            }
        }
        $this->setErrors('Users Not Found  to be update');
        return false;
    }

    /** set User as deleted
     * @param $id
     * @return bool
     */
    public function setUserAsDeleted($id){
        if($user = Users::find($id)){
            // New data
            $user->deleted  = 1;
            try{
                // Save
                $check = $user->save();
                if ($check)
                    return true;
                $this->setErrors('can\'t added to DB');
                return false;
            }catch (QueryException $e){
                $this->setErrors('update Users QueryException');
                return  false;
            }
        }
        $this->setErrors('Users Not Found  to be update');
        return false;
    }

    /**
     * get users in groups or cities or deleted
     * @param int $group
     * @param int $city
     * @param int $deleted
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsers($group = 0 , $city = 0, $deleted = 0){
        try{
            if($city && $group)
                return Users::where('group',$group)->where('city',$city)->where('deleted',$deleted)->get();
            if($city && !$group)
                return Users::where('city',$city)
                        ->where('deleted',$deleted)
                        ->get();
            if(!$city && $group)
                return Users::where('group',$group)
                        ->where('deleted',$deleted)
                        ->get();
        } catch (QueryException $e){
            $this->setErrors('get Users QueryException');
            return [];
        }

    }
}
