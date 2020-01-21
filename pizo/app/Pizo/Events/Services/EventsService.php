<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 6/11/2018
 * Time: 12:10 PM
 */
namespace App\Pizo\Events\Services;



use App\Pizo\Events\Repositories\EventsRepository;
use App\Pizo\Services;
use Illuminate\Support\Facades\Input;

class EventsService extends Services
{
    private $EventsRepo;
    public function __construct(){
        $this->EventsRepo = new EventsRepository();
    }

    /** create new event
     * @return \Illuminate\Http\JsonResponse
     */
    public function newEvent(){

        $rules = [
            "title"         => "required|max:500",
            "description"   => "required|max:37000",
            "date"          => "required|date",
            "coordinated"   => "required",
            "payed"         => "required"
        ];

        $validator = \Validator::make(Input::all(), $rules);
        if($validator->passes()){
            $data = new \stdClass();

            $data->title        = $this->xss_clean(Input::get('title'));
            $data->description  = $this->xss_clean(Input::get('desctiption'));
            $data->date         = $this->xss_clean(Input::get('date'));
            $data->coordinated  = $this->xss_clean(Input::get('coordinated'));
            $data->price        = $this->xss_clean(Input::get('price'));
            $data->owner_id     = 1;//\Auth::id();
            $data->payed        = 0;
            $data->featured     = 0;
            $data->deleted      = 0;

            $check = $this->EventsRepo->addNewEvent($data);
            if ($check){

                $res = [
                    'msg' => 'Event has been creased',
                    'id'  => $this->EventsRepo->getId(),
                    "error" => '0'
                ];

                return response()->json($res, 200);
            } else {

                $res = [
                    'msg' => $this->getErrors()[0],
                    "error" => '1'
                ];

                return response()->json($res, 200);
            }

        } else {

            $res = [
                'msg' => $validator->errors()->all()[0],
                "error" => '1'
            ];

            return response()->json($res, 200);

        }
    }

    public function setEventImage($request)
    {


        $rules = [
            'image' => 'required|image'
        ];

        $validation = \Validator::make(Input::all(), $rules);
        if ($validation->passes()) {
            $file = $request->file('image');
            //Move Uploaded File
            $destinationPath = 'uploads/events';
            $new_name = sha1(date("D M j G:i:s.u T Y")) . ".png";

            $image = $file->move($destinationPath, $new_name);

            $event_id = request()->route('id');

            if ($this->EventsRepo->setEventImage($event_id, $image))
                return response()->json(['msg' => "Image Uploaded", "error" => '0'], 200);

            return response()->json(['msg' => $this->EventsRepo->getErrors()[0], "error" => '1'], 200);

        } else {
            $this->setErrors($validation->errors()->all()[0]);
            return response()->json(['msg' => $this->getErrors()[0], "error" => '1'], 200);
        }


    }

    /** get all events
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllEvents(){
        $events = $this->EventsRepo->getAllEvents();

        $res = [
            'msg'       => 'Events',
            'events'    => $events,
            "error"     => '0'
        ];

        return response()->json($res,200);
    }

    /** get event info
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById($id){

        $event = $this->EventsRepo->getEvent((int)$id);
        if(!$event){

            $res = [
                'msg'       => 'Event Not Found',
                "error"     => '1'
            ];

            return response()->json($res,200);
        } else {

            $res = [
                'msg'       => 'Event',
                'event'     => $event,
                "error"     => '0'
            ];

            return response()->json($res,200);

        }

    }

    /** delete
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){

       if($this->EventsRepo->setDeleted($id)){
           $res = [
               'msg'       => 'Event, deleted',
               "error"     => '0'
           ];

           return response()->json($res,200);
       }
    }
}