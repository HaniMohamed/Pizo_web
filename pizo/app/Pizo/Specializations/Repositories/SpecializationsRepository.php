<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 4/4/2018
 * Time: 11:26 AM
 */

namespace App\Pizo\Specializations\Repositories;


use app\Pizo\Repositories;
use App\Pizo\Specializations\Models\Specializations;
use Illuminate\Database\QueryException;

class SpecializationsRepository extends Repositories
{

    /** get all Specializations
     * @param $deleted
     * @return array|static
     */
    public function getAllSpecializations($deleted = 0){
        try{
            return Specializations::all()->where('deleted','=',(int)$deleted);
        } catch (QueryException $e){
            return [];
        }
    }

    /** new Specialization
     * @param \stdClass $data
     * @return bool
     */
    public function addSpecializations(\stdClass $data){

        $spec = new Specializations();
        $spec->name         = $data->name;
        $spec->sub_spec     = $data->sub_spec;
        $spec->deleted      = 0;
        try{

           $check = $spec->save();
           if($check)
               return true;
           $this->setErrors('can\'t added to DB');
           return false;

        } catch (QueryException $e){

            $this->setErrors('add Specializations QueryException');
            return false;

        }
    }

    /**
     * set Specializations deleted
     * @param $id
     * @return bool
     */
    public function delete($id){
        if($spec = Specializations::fine()){
            $spec->deleted  = 1;
            try{
                $check = $spec->save();
                if ($check)
                    return true;
                $this->setErrors('can\'t be deleted to DB');
                return false;
            } catch (QueryException $e){
                $this->setErrors('delete Specializations QueryException');
                return false;
            }
        }
        $this->setErrors('Specialization not found');
        return false;
    }
}