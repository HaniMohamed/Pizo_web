<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 4/4/2018
 * Time: 12:32 PM
 */

namespace App\Pizo\Categories\Repositories;


use App\Pizo\Categories\Models\Categories;
use app\Pizo\Repositories;

class CategoriesRepository extends Repositories
{
    public function getAll(){
        return Categories::all();
    }
}