<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 5/10/2018
 * Time: 8:03 PM
 */
namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Pizo\Products\Services\ProductsService;
use Illuminate\Http\Request;

class productsController extends Controller
{

    private $ProductsServices;

    public function __construct(){

        $this->middleware(['jwt.auth'],['only'=>[
            'delete','update','add','image'
        ]]);

        $this->middleware('product.owner',['only'=>[
            'update','delete','image'
        ]]);

        $this->prodcutServices= new ProductsService();
    }

    /** add
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(){
        return $this->prodcutServices->AddNewProduct();
    }

    public function image(request $request){

        return $this->prodcutServices->setProductImage($request);

    }

    /** update
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(){
        return $this->prodcutServices->updateProduct();
    }

    /** delete
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(){
        return $this->prodcutServices->delete();
    }

    /**get product
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(){
        return $this->prodcutServices->get();
    }

    /** get products
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(){
        return $this->prodcutServices->all();
    }

}