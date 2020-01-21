<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 4/4/2018
 * Time: 1:22 PM
 */

namespace App\Pizo\Asks\Repositories;


use App\Pizo\Asks\Models\AsksMessages;
use app\Pizo\Repositories;
use Illuminate\Database\QueryException;

class AsksMessagesRepository extends Repositories
{
    /**
     * Add new Message for Asking
     * @param \stdClass $message
     * @return bool
     */
    public function addMessage(\stdClass $message){
        $msg = new AsksMessages();

        $msg->ask_id    = $message->ask_id;
        $msg->sender_id = $message->sender_id;
        $msg->message   =   $message->message;

        try{
            if ($msg->save())
                return true;

            $this->setErrors('Message can\' be sent');
            return false;
        } catch (QueryException $e){

            $this->setErrors('Add Message QueryException');
            return false;
        }
    }


    /**
     * get All messages of specific Ask
     * @param $ask_id
     * @return static
     */

    public function getAskMessage($ask_id){
        return AsksMessages::all()->where('ask_id', '=',$ask_id);
    }

}