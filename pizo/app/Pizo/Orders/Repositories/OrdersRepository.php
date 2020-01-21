<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 4/4/2018
 * Time: 1:34 PM
 */

namespace App\Pizo\Orders\Repositories;


use App\Pizo\EngineersOrders\Repositories\EngineersOrdersRepository;
use App\Pizo\Orders\Models\Orders;
use App\Pizo\Repositories;
use App\Pizo\Users\Repositories\usersRepositories;
use Illuminate\Database\QueryException;

class OrdersRepository extends Repositories
{
    private $id;

    /** Add new Order
     * @param \stdClass $data
     * @return bool
     */
    public function newOrder( \stdClass $data){

        $order = new Orders();
        $order->title       = $data->title;
        $order->description = $data->description;
        $order->doctor_id   = (int) $data->doctor_id;
        $order->deleted     = 0;

        $userRepo = new usersRepositories();
        $OrderCoor = $userRepo->getUserLatLng($order->doctor_id);

        if(empty($OrderCoor)){
            $this->setErrors('Please Set location first');
            return false;
        }

        try{

            if($order->save()){
                $this->id = $order->id;


                $lat = $OrderCoor["lat"];
                $lng = $OrderCoor["lng"];

                $range = 5;
                $step  = 0;

                $group_id = 2;

                $users = [];
                while(empty($users) && $step < 10) {
                    $users = $userRepo->getUsersOfLatLngRange($lat, $lng, $range, $step, $group_id);
                    $step += 1;
                }

                $OrEngRepo = new EngineersOrdersRepository();

                if(empty($users) && $order->delete()){
                    $this->setErrors('Maintain Orders Not available in your area right now');
                    return false;
                }


                foreach ($users as $user){
                    $OrEngRepo->addEngineerOrders($order->id,$user->id);
                }


                return true;
            }

            $this->setErrors('Order can\'t be saved');
            return false;
        } catch (QueryException $e){

            $this->setErrors('Add Order QueryException');
            return false;
        }
    }


    public function getOrderInfo($id){
        if($order = Orders::find($id))
            return $order;
        return false;
    }

    /**
     * @return int
     */
    public function getOrderId(){
        return $this->id;
    }

    /** Set Order Image
     * @param $order_id
     * @param $image_uri
     * @return bool
     */
    public function setOrderImage($order_id, $image_uri){

        if($order = Orders::find((int) $order_id)){

            $order->image    = $image_uri;

            try{

                if($order->save())
                    return true;

                $this->setErrors('Order  Image can not be saved right now');
                return false;

            } catch (QueryException $e){
                $this->setErrors('Order  Set Order Image QueryException');
                return false;
            }

        } else {
            $this->setErrors('Order  not found');
            return false;
        }

    }

    /** set Order Cost
     * @param $id
     * @param $cost
     * @return bool
     */
    public function setOrderCost($id, $cost){
        if(!$order = Orders::find((int)$id)){
            $this->setErrors("Order Not found");
            return false;
        }

        $order->cost = $cost;

        try{
            if ($order->cost())
                return true;
            $this->setErrors("Order Cost Can't be set");
            return false;
        } catch (QueryException $e){

            $this->setErrors("Set Order Cost QueryException");
            return false;
        }
    }

    /** set Order as Deleted
     * @param $id
     * @return bool
     */
    public function deleteOrder($id){
        if($order = Orders::find($id)){
            $order->deleted = 1;

            try{
                if($order->save())
                    return true;

                $this->setErrors("Order Can't be set as deleted");
                return false;
            } catch (QueryException $e){

                $this->setErrors("Delete Order QueryException");
                return false;
            }
        }
        $this->setErrors("Order Not found");
        return false;
    }


    /** Set the Review for The Engineer
     * @param $id
     * @param $review
     * @return bool
     */
    public function DoctorRatesEngineer($id,\stdClass $review){
        if(!$order = Orders::find((int)$id)){
            $this->setErrors("Order Not found");
            return false;
        }

        $order->engineer_rate     = $review->rate;
        $order->engineer_review   = $review->review;

        try{
            if($order->save())
                return true;

            $this->setErrors("Review can't be added");
            return false;
        } catch (QueryException $exception){

            $this->setErrors("Engineer Review QueryException");
            return false;
        }

    }

    /** Set the Review for The Doctor
     * @param $id
     * @param \stdClass $review
     * @return bool
     */
    public function EngineerRatesDoctor($id,\stdClass $review){
        if(!$order = Orders::find($id)){
            $this->setErrors("Order Not found");
            return false;
        }

        $order->doctror_rate = $review->rate;
        $order->doctor_review = $review->review;

        try{
            if($order->save())
                return true;

            $this->setErrors("Review can't be added");
            return false;
        } catch (QueryException $exception){

            $this->setErrors("Doctor Review QueryException");
            return false;
        }

    }

    /** set the id of the user how receive the cost
     * @param $id
     * @param $receiver
     * @return bool
     */
    public function setCostReceiver($id,$receiver){
        if(!$order = Orders::find($id)){
            $this->setErrors("Order Not found");
            return false;
        }

        $order->receiver = (int)$receiver;

        try{
            if($order->save())
                return true;

            $this->setErrors('Order Reciever Can\'t be modified');
            return false;
        } catch (QueryException $e){

            $this->setErrors('Receiver Cost QueryException');
            return false;
        }

    }

    /** set the order as Achieved
     *  Just by the order Engineer
     * @param $id
     * @return bool
     */
    public function EngineerOrderAchieved($id){
        if(!$order = Orders::find($id)){
            $this->setErrors("Order Not found");
            return false;
        }

        $order->engineer_done = 1;

        try{
            if($order->save())
                return true;

            $this->setErrors('Order can not be set as achieved');
            return false;
        } catch (QueryException $e){

            $this->setErrors('set Order Achieved QueryException');
            return false;
        }
    }

}