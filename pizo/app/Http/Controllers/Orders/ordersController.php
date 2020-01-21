<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Pizo\Orders\Services\OrdersService;
use Illuminate\Http\Request;


class ordersController extends Controller
{
    private $ordersServices;

    /**
     * ordersController constructor.
     */
    public function __construct(){

        // TODO:: doctor middleware
        $this->middleware(['jwt.auth','doctor'],['only'=>[
            'addOrder','deleteOrder','uploadOrderImage','getEngineers'
        ]]);

        $this->middleware('order.owner',['only'=>[
            'uploadOrderImage','deleteOrder'
        ]]);

        $this->ordersServices = new OrdersService();
    }

    /**
     * Get engineers
     */
    public function getEngineers(){
        return $this->ordersServices->Engineers();
    }
    /**
     * @return add new order
     */
    public function addOrder(){
        return $this->ordersServices->addNewOrder();
    }

    /**
     * Set Upload Order Image
     */
    public function uploadOrderImage(request $request){

        return $this->ordersServices->setOrderImage($request);

    }

    public function getOrderInfo(){
        return $this->ordersServices->getOrder();
    }

    /**
     * doctor delete order
     */
    public function deleteOrder($id){
        return $this->ordersServices->deleteOrder();
    }

}
