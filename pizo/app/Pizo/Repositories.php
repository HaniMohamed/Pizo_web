<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 1/29/2018
 * Time: 2:16 PM
 */

namespace App\Pizo;


class Repositories
{
    private $errors = [];


    public function setErrors($errors)
    {
        try {
//            die(var_dump($errors));
            if(is_string($errors))
                $this->errors = array_merge($this->errors, [$errors]);
            else
                $this->errors = array_merge($this->errors, $errors);
            return true;
        } catch (Exception $exception){
            die("Services ERRORS Merging Exception");
//            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}