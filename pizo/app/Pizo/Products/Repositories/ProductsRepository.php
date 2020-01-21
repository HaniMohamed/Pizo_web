<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 4/4/2018
 * Time: 2:58 PM
 */

namespace App\Pizo\Products\Repositories;


use App\Pizo\Products\Models\Products;
use App\Pizo\Repositories;
use Illuminate\Database\QueryException;

class ProductsRepository extends Repositories
{
    private $id = 0;
    /** add new product
     * @param \stdClass $data
     * @return bool
     */
    public function addProduct(\stdClass $data){

        $product = new Products();

        $product->title             = $data->title;
        $product->description       = $data->description;
        $product->price             = $data->price;
        $product->owner_id          = $data->owner_id;
        $product->specialization_id = $data->specialization_id;
        $product->category_id       = $data->category_id;

        try{
            if($product->save()){
                $this->id = $product->id;
                return true;
            }

            $this->setErrors('Product can not be saved');
        } catch (QueryException $e){

            $this->setErrors('Add Product QueryException');
            return false;
        }
    }

    public function setProductImage($product_id, $image_uri){

        if($product = Products::find((int) $product_id)){

            $product->image    = $image_uri;

            try{

                if($product->save())
                    return true;

                $this->setErrors('Product  Image can not be saved right now');
                return false;

            } catch (QueryException $e){
                $this->setErrors('Product  Set Order Image QueryException');
                return false;
            }

        } else {
            $this->setErrors('Product  not found');
            return false;
        }

    }

    /** update product
     * @param $id
     * @param \stdClass $data
     * @return bool
     */

    public function updateProduct($id,\stdClass $data){
        if($product = Products::find((int)$id)){

            $product->title             = $data->title;
            $product->description       = $data->description;
            $product->price             = $data->price;
            $product->specialization_id = $data->specialization_id;
            $product->category_id       = $data->category_id;

            try{
                if($product->save())
                    return true;

                $this->setErrors('Product can not be updated');
                return flase;
            } catch (QueryException $e){

                $this->setErrors('update Product QueryException');
                return false;
            }
        } else {
            $this->setErrors('Product can not be found');
            return flase;
        }

    }


    /** delete product by id
     * @param $id
     * @return bool
     */
    public function deleteProduct($id){
        if($product = Products::find($id))
            return $product->delete();

        $this->setErrors('Product can not be saved');
        return false;
    }

    /** get
     * @param int $id
     * @return Products[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get($id = 0){
        if($id == 0)
            return \DB::table('products')
                ->join('specializations','specializations.id','=','products.specialization_id')
                ->join('users','users.id','=','products.owner_id')
                ->select(['products.*','specializations.name as specialization_name','users.name as owner_name'])
                ->where('category_id','<',4)
                ->get();

        return \DB::table('products')
            ->join('specializations','specializations.id','=','products.specialization_id')
            ->join('users','users.id','=','products.owner_id')
            ->select(['products.*','specializations.name as specialization_name','users.name as owner_name'])
            ->where('products.id' ,'=',$id)
            ->first();
    }

    public function clinics($id = 0){
        if($id == 0)
            return \DB::table('products')
                ->join('specializations','specializations.id','=','products.specialization_id')
                ->join('users','users.id','=','products.owner_id')
                ->select(['products.*','specializations.name as specialization_name','users.name as owner_name'])
                ->where('category_id','>',3)
                ->get();

        return \DB::table('products')
            ->join('specializations','specializations.id','=','products.specialization_id')
            ->join('users','users.id','=','products.owner_id')
            ->select(['products.*','specializations.name as specialization_name','users.name as owner_name'])
            ->where('products.id' ,'=',$id)
            ->first();
    }

    /**
     * @return int
     */
    public function getProductId(){
        return $this->id;
    }

}