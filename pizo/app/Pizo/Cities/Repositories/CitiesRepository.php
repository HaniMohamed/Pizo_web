<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 4/4/2018
 * Time: 12:20 PM
 */

namespace App\Pizo\Cities\Repositories;


use App\Pizo\Cities\Models\Cities;
use app\Pizo\Repositories;
use Illuminate\Database\QueryException;

class CitiesRepository extends Repositories
{
    public function getCities()
    {
        try{
            return Cities::all();
        } catch (QueryException $exception){

            $this->setErrors('Get Cities QueryException');
            return [];
        }
    }

}