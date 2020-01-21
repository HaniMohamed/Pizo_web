<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 5/14/2018
 * Time: 4:06 PM
 */
namespace App\Http\Controllers\Messages;


use App\Http\Controllers\Controller;
use App\Pizo\Messages\Services\ConversationsService;

class MessagesController extends Controller
{
    private $serve;

    public function __construct()
    {
        $this->middleware('jwt.auth',['only'=>[
            'create','send','messages','info','user'
        ]]);

        $this->middleware('conversation.owner',['only'=>[
            'send','messages','info'
        ]]);

        $this->serve = new ConversationsService();
    }

    /**
     * @param $cid
     * @return \Illuminate\Http\JsonResponse
     */
    public function info($cid){
        return $this->serve->getConversationInfo((int)$cid);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(){
        return $this->serve->newConversation();
    }

    /**
     * @param $cid
     * @return \Illuminate\Http\JsonResponse
     */
    public function messages($cid){
        return $this->serve->getConversationMessages($cid);
    }

    /**
     * @param $cid
     * @return \Illuminate\Http\JsonResponse
     */
    public function send($cid){
        return $this->serve->send((int)$cid);
    }

    /** User conversation
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(){
        return $this->serve->userConversations();
    }
}