<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 4/4/2018
 * Time: 12:40 PM
 */

namespace App\Pizo\Asks\Repositories;


use App\Pizo\Asks\Models\Asks;
use app\Pizo\Repositories;
use Illuminate\Database\QueryException;

class AsksRepository extends Repositories
{

    /** Add new Ask
     * @param $doc_id
     * @param $cons_id
     * @param $product_id
     * @return bool
     */
    public function addAsk($doc_id,$cons_id,$product_id){
        $ask = new Asks();

        $ask->doctor_id = $doc_id;
        $ask->cons_id   = $cons_id;
        $ask->product_id = $product_id;

        try{
            if ($ask->save())
                return true;

            $this->setErrors('Can\'t Add Ask');
            return false;
        } catch (QueryException $exception) {

            $this->setErrors('Add Ask QueryException');
            return false;
        }
    }


    /** get the doctor Asks
     * @param $id
     * @return array|static
     */
    public function getDoctorAsks($id){
        try{

            $asks = Asks::all()->where('doctor_id','=',$id);
            return $asks;

        } catch (QueryException $exception) {

            $this->setErrors('Get Doctor Asks QueryException');
            return [];

        }
    }

    /** Get Cons Asks
     * @param $id
     * @return array|static
     */
    public function getConsAsks($id){
        try{

            $asks = Asks::all()->where('cons_id','=',$id);
            return $asks;

        } catch (QueryException $exception) {

            $this->setErrors('Get Consultants Asks QueryException');
            return [];

        }
    }
}