<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 6/11/2018
 * Time: 12:51 PM
 */
namespace App\Http\Controllers\Events;


use App\Http\Controllers\Controller;
use App\Pizo\Events\Services\EventsService;
use Illuminate\Http\Request;


class EventsController extends Controller
{
    private $EventService;
    public function __construct()
    {
        $this->middleware('jwt.auth',['only'=>[
            'index','store','show','destroy','image'
        ]]);

        $this->middleware('event.owner',['only'=>[
            'destroy','image'
        ]]);

        $this->EventService = new EventsService();
    }

    /** all events
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return $this->EventService->getAllEvents();
    }

    /** add event
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(){
        return $this->EventService->newEvent();
    }

    /** event by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id){
        return $this->EventService->getById($id);
    }

    /** delete event
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id){
        return $this->EventService->delete((int)$id);
    }

    /** set event image
     * @return mixed
     */
    public function image(request $request){
        return $this->EventService->setEventImage($request);
    }
}