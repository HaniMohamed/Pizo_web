<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 7/23/2018
 * Time: 9:45 AM
 */
namespace App\Pizo\EngineersOrders\Repositories;

use App\Pizo\EngineersOrders\Models\EngineersOrders;
use \App\Pizo\Repositories;
use Illuminate\Database\QueryException;

class EngineersOrdersRepository extends Repositories
{

    /** Add Order TO engineer
     * @param $order
     * @param $engineer
     * @return bool
     */
    public function addEngineerOrders($order,$engineer){
        $line = new EngineersOrders();

        $line->engineer_id  = $engineer;
        $line->order_id     = $order;

        try{

            return $line->save();

        } catch (QueryException $e){

            $this->setErrors("add Order $order Engineer $engineer Query Exception");
            return false;
        }
    }

    /** set accept
     * @param $line_id
     * @return bool
     */
    public function EngineerAcceptOrder($line_id,$engineer_id){

        if(!$line = EngineersOrders::find($line_id)){
            $this->setErrors("Not found");
            return false;
        }

        if($line_id->enginner != $engineer_id){
            $this->setErrors("not allowed");
            return false;
        }

        $order = $line->order_id;

        $ordersLines = EngineersOrders::query()
            ->where("order_id",$order)
            ->where("accepted", "1")
            ->get();

        if(count($ordersLines) > 0){
            $this->setErrors("Sadly, another Engineer has been accept the order.");
            return false;
        } else {

            $line->accepted = 1;
            try{

                return $line->save();

            } catch (QueryException $e){
                $this->setErrors("Order $line_id can't be accepted");
                return false;
            }
        }
    }

    /** Set Order Refused by the Engineer
     * @param $line_id
     * @param $engineer_id
     * @return bool
     */
    public function EngineerRefuse($line_id,$engineer_id){

        if(!$line = EngineersOrders::find($line_id)){
            $this->setErrors("Not found");
            return false;
        }

        if($line->enginner != $engineer_id){
            $this->setErrors("not allowed");
            return false;
        }

        return $line->delete();
    }

}