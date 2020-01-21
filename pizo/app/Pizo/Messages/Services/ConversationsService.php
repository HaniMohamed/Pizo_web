<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 8/1/2018
 * Time: 3:09 PM
 */

namespace App\Pizo\Messages\Services;

use App\Pizo\Messages\Repositories\ConversationsRepository;
use App\Pizo\Services;
use Illuminate\Support\Facades\Input;

class ConversationsService extends Services
{
    private $repo;

    public function __construct()
    {
        $this->repo = new ConversationsRepository();
    }


    /** Create new conversation
     * @return \Illuminate\Http\JsonResponse
     */
    public function newConversation(){
        $rules = [
            "title" => "required|min:1",
            "receiver" => "required|int"
        ];

        $validator = \Validator::make(Input::all(),$rules);

        if($validator->passes()){

            $sender_id = \Auth::id();
            $receiver_id = (int) Input::get("receiver");
            $title      = $this->xss_clean(Input::get("title"));

            $check = $this->repo->newConversation($title, $sender_id, $receiver_id);
            if($check){
                $res = [
                    "msg"=>"conversation created",
                    "id"=>$this->repo->getCId(),
                    "error"=>0
                ];

                return response()->json($res,200);
            }

            $res = [
                "msg"=>"conversation created",
                "id"=>$this->repo->getErrors()[0],
                "error"=>1
            ];

            return response()->json($res,200);

        }

        $res = [
            "msg"=>$validator->errors()->all()[0],
            "error"=>1
        ];

        return response()->json($res,200);
    }

    /** send Message
     * @param $cid
     * @return \Illuminate\Http\JsonResponse
     */
    public function send($cid){

        $rules = [
            "message" => "required|min:0"
        ];

        $validator = \Validator::make(Input::all(),$rules);

        if($validator->passes()){

            $message = $this->xss_clean(Input::get("message"));

            if($this->repo->sendMessage($message,(int) $cid,(int) \Auth::id())){
                $res = [
                    "msg" => "message'd been sent",
                    "error" =>0
                ];

                return response()->json($res, 200);
            }


            $res = [
                "msg" => $this->repo->getErrors()[0],
                "error" =>1
            ];

            return response()->json($res, 200);
        }

        $res = [
            "msg" => $validator->errors()->all()[0],
            "error" =>1
        ];

        return response()->json($res, 200);

    }

    /** Conversation Messages
     * @param $cid
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConversationMessages($cid)
    {
        $messages = $this->repo->getConversationMessages((int) $cid);

        $res = [
            "msg" => "Conversation Messages",
            "messages"=>$messages,
            "error" =>0
        ];

        return response()->json($res, 200);

    }

    public function getConversationInfo($cid)
    {
        if($conv = $this->repo->getConversation((int) $cid)) {
            $res = [
                "msg" => "Conversation Info",
                "conversation" => $conv,
                "error" => 0
            ];

            return response()->json($res, 200);
        }

        $res = [
            "msg" => "Not found",
            "conversation" => [],
            "error" => 1
        ];

        return response()->json($res, 200);

    }

    /** Get User Conversation
     * @return \Illuminate\Http\JsonResponse
     */
    public function userConversations()
    {
        $convs = $this->repo->getUserConversations(\Auth::id());

            $res = [
                "msg" => "Users Conversations",
                "conversation" => $convs,
                "error" => 0
            ];

            return response()->json($res, 200);

    }

}