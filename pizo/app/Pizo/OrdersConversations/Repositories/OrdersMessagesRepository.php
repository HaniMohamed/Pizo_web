<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 4/4/2018
 * Time: 2:35 PM
 */

namespace App\Pizo\OrdersConversations\Repositories;


use App\Pizo\OrdersConversations\Models\OrdersMessages;
use App\Pizo\Repositories;
use Illuminate\Database\QueryException;

class OrdersMessagesRepository extends Repositories
{
    /** add a message to a conversation of order
     * @param \stdClass $data
     * @return bool
     */
    public function addMessage(\stdClass $data){

        $msg = new OrdersMessages();

        $msg->order_id          = $data->order_id;
        $msg->sender_id         = $data->sender_id;
        $msg->message           = $data->message;

        try{
            if($msg->save())
                return true;

            $this->setErrors('Order Conversation Message Can not be added');
            return false;
        } catch (QueryException $e){

            $this->setErrors('Order Conversation QueryException');
            return false;
        }
    }

    /** Get all message of conversation
     * @param $conv_id
     * @return static
     */
    public function getOrderMessages($order_id){
        return OrdersMessages::all()->where('order_id','=',(int)$order_id);
    }

}