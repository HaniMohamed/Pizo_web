<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 4/4/2018
 * Time: 12:05 PM
 */

namespace App\Pizo\Groups\Repositories;


use App\Pizo\Groups\Models\Groups;
use app\Pizo\Repositories;
use Illuminate\Database\QueryException;

class GroupsRepository extends Repositories
{
    /** create new  users group
     * @param $name
     * @return bool
     */
    public function addGroup($name){
        $group = new Groups();
        $group -> name = $name;
        $group->deleted = 0;

        try{
            if($check = $group->save())
                return true;

            $this->setErrors('ca\'t be added to the groups table');
            return false;
        } catch (QueryException $e){

            $this->setErrors('Add Groups QueryException');
            return false;
        }

    }

    /** Get all Users groups
     * @param int $deleted
     * @return array|static
     */
    public function getGroups($deleted = 0){

        try {
            return Groups::all()->where('deleted', '=', $deleted);
        } catch (QueryException $e){

            $this->setErrors('get  Groups QueryException');
            return [];
        }

    }

}