<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 5/10/2018
 * Time: 8:03 PM
 */
namespace App\Http\Controllers\Clinics;

use App\Http\Controllers\Controller;
use App\Pizo\Products\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class productsController extends Controller
{

    private $ProductsServices;

    public function __construct(){

        $this->middleware(['jwt.auth','admin'],['only'=>[
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
        if(Input::get('category_id') < 4)
        return response()->json([
            'msg' => 'the selected category no clinical',
            'error' => 1
        ],400);

        return $this->prodcutServices->AddNewProduct();
    }

    /** update
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(){
        if(Input::get('category_id') < 4)
        return response()->json([
            'msg' => 'the selected category no clinical',
            'error' => 1
        ],400);
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
        return $this->prodcutServices->clinics();
    }

    public function image(request $request){

        return $this->prodcutServices->setProductImage($request);

    }

}