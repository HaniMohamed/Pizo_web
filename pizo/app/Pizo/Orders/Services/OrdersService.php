<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 4/28/2018
 * Time: 5:44 PM
 */

namespace App\Pizo\Orders\Services;


use App\Http\Requests\Request;
use App\Pizo\Orders\Repositories\OrdersRepository;
use App\Pizo\Services;
use App\Pizo\Users\Models\Users;
use App\Pizo\Users\Repositories\usersRepositories;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Input;

class OrdersService extends Services
{
    private $OrdersRepository;

    public function __construct()
    {
        $this->OrdersRepository = new OrdersRepository();
    }

    /** get Engineers
     * @return \Illuminate\Http\JsonResponse
     */
    public function Engineers(){
        $users = new usersRepositories();

        $city = (int)Input::get('city') > 0?(int)Input::get('city'):0 ;

        $engineers  = $users->getUsers(2,$city);
        return response()->json(['msg' => "Engineers", 'engineers'=> $engineers ,"error" => '0'], 200);

    }
    /**
     *
     * add new orders
     */
    public function addNewOrder()
    {

        $rules = [
            "title" => "required|min:1|unique:orders",
            "description" => "required|min:20",
        ];


        $validator = \Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $order = new \stdClass();
            $order->title = $this->xss_clean(Input::get('title'));
            $order->description = $this->xss_clean(Input::get('description'));
            $order->doctor_id = \Auth::id();



            if ($this->OrdersRepository->newOrder($order)) {

                $id = $this->OrdersRepository->getOrderId();


                $res = [
                    'msg' => "Order Has Been Created",
                    "id" => $id,
                    "error" => '0'
                ];

                return response()->json($res, 200);
            }


            $this->setErrors($this->OrdersRepository->getErrors());
            return response()->json(['msg' => $this->getErrors()[0], "error" => '1'], 200);
        } else {
            $this->setErrors($validator->errors()->all()[0]);
            return response()->json(['msg' => $this->getErrors()[0], "error" => '1'], 200);
        }
    }

    /** OrderImage
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setOrderImage($request)
    {

        $rules = [
            'image' => 'required|image'
        ];

        $validation = \Validator::make(Input::all(), $rules);
        if ($validation->passes()) {
            $file = $request->file('image');
            //Move Uploaded File
            $destinationPath = 'uploads/orders';
            $new_name = sha1(date("D M j G:i:s.u T Y")) . ".png";

            $image = $file->move($destinationPath, $new_name);

            $order_id = request()->route('id');

            if ($this->OrdersRepository->setOrderImage($order_id, $image))
                return response()->json(['msg' => "Image Uploaded", "error" => '0'], 200);

            return response()->json(['msg' => $this->OrdersRepository->getErrors()[0], "error" => '1'], 200);

        } else {
            $this->setErrors($validation->errors()->all()[0]);
            return response()->json(['msg' => $this->getErrors()[0], "error" => '1'], 200);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrder()
    {
        if (!$id = request()->route('id')) {
            return response()->json(['msg' => "Id must be given", "error" => '1'], 200);
        }

        $order = $this->OrdersRepository->getOrderInfo($id);

        if ($order = $this->OrdersRepository->getOrderInfo($id))
            return response()->json(['msg' => "Found", "order" => $order, "error" => '0'], 200);

        return response()->json(['msg' => "Not found", "error" => '1'], 200);


    }

    /** set Order deleted
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteOrder()
    {
        if ($this->OrdersRepository->deleteOrder((int)request()->route('id')))
            return response()->json(['msg' => "Order Has Been Deleted", "error" => '0'], 200);

        return response()->json(['msg' => $this->OrdersRepository->getErrors()[0], "error" => '1'], 200);
    }
}