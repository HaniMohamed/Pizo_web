<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 8/1/2018
 * Time: 2:23 PM
 */

namespace App\Pizo\Messages\Repositories;


use App\Pizo\Messages\Models\Conversations;
use App\Pizo\Messages\Models\Messages;
use App\Pizo\Repositories;
use Mockery\Exception;

class ConversationsRepository extends Repositories
{
    private $c_id = 0;

    /** Check if conversation exist
     * @param $title
     * @param $int
     * @param $int1
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null
     */

    public function getConversationByTitle($title,$int,$int1){

        if(!$conversation = Conversations::query()
            ->where('user1',$int)
            ->where('user2',$int1)
            ->where("title",$title)
            ->first())

            $conversation = Conversations::query()
                ->where('user1',$int1)
                ->where('user2',$int)
                ->where("title",$title)
                ->first();

        return $conversation;
    }

    /** get conversation info
     * @param $cid
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null
     */
    public function getConversationInfo($cid){

        $conversation = Conversations::query()
            ->where("id",$cid)
            ->first();

        return $conversation;
    }

    /** Create conversation between two users
     * @param $string
     * @param $int
     * @param $int1
     * @return bool
     */
    public function newConversation($string, $int, $int1)
    {
        if($conversation = $this->getConversationByTitle($string,$int,$int1)){
            $this->c_id = (int)$conversation->id;
            return true;
        }


        $conv = new Conversations();

        $conv->title = $string;
        $conv->user1 = $int;
        $conv->user2 = $int1;

        try{
            $x = $conv->save();
            if($x){
                $this->c_id = (int) $conv->id;
                return true;
            }

            $this->setErrors("conversation Creation saving failed");
            return false;

        } catch (Exception $e){
            $this->setErrors("conversation Creation DB Exception");
            return false;
        }
    }

    /** conversation Id
     * @return int
     */

    public function getCId(){
        return $this->c_id;
    }


    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function  getConversationMessages($id){
        $messages = Messages::query()
            ->where("conversation_id",$id)
            ->get();

        return $messages;
    }


    /**
     * @param $message
     * @param $cid
     * @param $sid
     * @return mixed
     */
    public function sendMessage($message,$cid,$sid){

        $line = new Messages();

        $line->message = $message;
        $line->conversation_id = $cid;
        $line->sender_id = $sid;

        try{
            return $line->save();
        } catch (Exception $e){

            $this->setErrors("Sending the message failed");
            return false;

        }

    }


    /** get conversation
     * @param $cid
     * @return mixed
     */
    public function getConversation($cid)
    {
        return Conversations::find($cid);
    }

    /** Get User Conversations
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUserConversations($user_id)
    {
        $conversations = Conversations::query()
            ->where("user1",(int)$user_id)
            ->orwhere("user2",(int)$user_id)
            ->get();

        return $conversations;
    }

}