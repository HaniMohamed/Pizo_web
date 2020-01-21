<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 5/10/2018
 * Time: 7:29 PM
 */


namespace App\Pizo\Products\Services;


use App\Pizo\Products\Repositories\ProductsRepository;
use App\Pizo\Services;
use Illuminate\Support\Facades\Input;

class ProductsService extends Services
{
    private $ProductsRepository;

    public function __construct()
    {
        $this->ProductsRepository = new ProductsRepository();
    }

    /** add new Product
     * @return \Illuminate\Http\JsonResponse
     */
    public function AddNewProduct(){
        $rules = [
            "title"             => "required|min:10|max:200",
            "description"       => "required|max:1000",
            "price"             => "required",
            "specialization_id" => "required|int",
            "category_id"       => "required|int"
        ];

        $validator = \Validator::make(Input::all(), $rules);

        if($validator->passes()){

            $data = new \stdClass();

            $data->title        = $this->xss_clean(Input::get('title'));
            $data->description  = $this->xss_clean(Input::get('description'));
            $data->price        = (float) Input::get('price');
            $data->owner_id     = (int)\Auth::id();
            $data->category_id  = (int)Input::get('category_id');
            $data->specialization_id  = (int) Input::get('specialization_id');



            $check = $this->ProductsRepository->addProduct($data);

            if($check){
                $id = $this->ProductsRepository->getProductId();
                $res = [
                    'msg' => "Product Has Been Created",
                    "id" => $id,
                    "error" => '0'
                ];

                return response()->json($res, 200);

            } else {
                $res = [
                    'msg' => $this->ProductsRepository->getErrors()[0],
                    "error" => '1'
                ];

                return response()->json($res, 200);
            }

        } else {
            $res = [
                'msg' => $validator->errors()->all()[0],
                "error" => '1'
            ];

            return response()->json($res, 200);
        }
    }

    public function setProductImage($request){

        $rules = [
            'image' => 'required|image'
        ];

        $validation = \Validator::make(Input::all(), $rules);
        if ($validation->passes()) {
            $file = $request->file('image');
            //Move Uploaded File
            $destinationPath = 'uploads/products';
            $new_name = sha1(date("D M j G:i:s.u T Y")) . ".png";

            $image = $file->move($destinationPath, $new_name);

            $product_id = request()->route('id');

            if ($this->ProductsRepository->setProductImage($product_id, $image))
                return response()->json(['msg' => "Image Uploaded", "error" => '0'], 200);

            return response()->json(['msg' => $this->ProductsRepository->getErrors()[0], "error" => '1'], 200);

        } else {
            $this->setErrors($validation->errors()->all()[0]);
            return response()->json(['msg' => $this->getErrors()[0], "error" => '1'], 200);
        }


    }

    /** update
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProduct(){

        if (!$id = (int)request()->route('id'))
            return response()->json(['msg' => "Invalid Id", "error" => '1'], 200);

        $rules = [
            "title"             => "required|min:10|max:200",
            "description"       => "required|max:1000",
            "price"             => "required",
            "specialization_id" => "required|int",
            "category_id"       => "required|int"
        ];

        $validator = \Validator::make(Input::all(), $rules);

        if($validator->passes()){

            $data = new \stdClass();

            $data->title        = $this->xss_clean(Input::get('title'));
            $data->description  = $this->xss_clean(Input::get('description'));
            $data->price        = (float) Input::get('price');
            $data->category_id  = (int)Input::get('category_id');
            $data->specialization_id  = (int) Input::get('specialization_id');



            $check = $this->ProductsRepository->updateProduct($id,$data);

            if($check){
                $id = $this->ProductsRepository->getProductId();
                $res = [
                    'msg' => "Product Has Been Updated",
                    "error" => '0'
                ];

                return response()->json($res, 200);

            } else {
                $res = [
                    'msg' => $this->ProductsRepository->getErrors()[0],
                    "error" => '1'
                ];

                return response()->json($res, 200);
            }

        } else {
            $res = [
                'msg' => $validator->errors()->all()[0],
                "error" => '1'
            ];

            return response()->json($res, 200);
        }
    }

    /**delete product
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(){
        if (!$id = (int)request()->route('id'))
            return response()->json(['msg' => "Invalid Id", "error" => '1'], 200);


        if($this->ProductsRepository->deleteProduct($id))
            return response()->json(['msg' => "Product Deleted", "error" => '0'], 200);

        $res = [
            'msg' => $this->ProductsRepository->getErrors()[0],
            "error" => '1'
        ];

        return response()->json($res, 200);
    }

    /** get product
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(){
        if (!$id = (int)request()->route('id'))
            return response()->json(['msg' => "Invalid Id", "error" => '1'], 200);

        $product = $this->ProductsRepository->get($id);

        $res = [
            'msg' => 'products',
            'product' =>$product ,
            "error" => '0'
        ];

        return response()->json($res, 200);
    }

    /** all products
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(){
        $products = $this->ProductsRepository->get();

        $res = [
            'msg' => 'products',
            'products' =>$products,
            "error" => '0'
        ];

        return response()->json($res, 200);
    }

    public function clinics(){
        $products = $this->ProductsRepository->clinics();

        $res = [
            'msg' => 'products',
            'products' =>$products,
            "error" => '0'
        ];

        return response()->json($res, 200);
    }
}