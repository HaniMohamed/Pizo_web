<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 6/11/2018
 * Time: 11:39 AM
 */

namespace App\Pizo\Events\Repositories;

use App\Pizo\Events\Models\Event;
use App\Pizo\Repositories;
use Illuminate\Database\QueryException;

class EventsRepository extends Repositories
{
    private $id;
    public function addNewEvent($data){

        $event = new Event();

        $event->title = $data->title;
        $event->description = $data->description;
        $event->date        = $data->date;
        $event->payed       = $data->payed;
        $event->price       = $data->price;
        $event->owner_id    = $data->owner_id;
        $event->coordinated = $data->coordinated;
        $event->deleted     = $data->deleted;
        $event->featured    = $data->featured;

        try{
            $check = $event->save();
            if ($check) {
                $this->id = $event->id;
                return true;
            }

            $this->setErrors("Event can't be saved.");
            return false;

        } catch (QueryException $e){
            $this->setErrors("Query Exception");
            return false;
        }
    }

    /** get Event Id
     * @return id
     */

    public function getId(){
        return $this->id;
    }

    /** Set an event as deleted
     * @param $id
     * @return bool
     */
    public function setDeleted($id){
        if($event = Event::find($id)){

            $event->deleted = 1;
            $event->save();

            return true;
        }

        $this->setErrors("Event Not found");

        return false;
    }

    /** set event featured
     * @param $id
     * @return bool
     */
    public function setFeatured($id){
        if($event = Event::find($id)){

            $event->featured = 1;
            $event->save();

            return true;
        }

        $this->setErrors("Event Not found");

        return false;
    }

    public function getAllEvents(){
        return   \DB::table('events')
            ->join('users','users.id','=','events.owner_id')
            ->select('events.*', 'users.name as owner_name')
            ->where('events.deleted','=',0)
            ->get();
    }


    /** get an event info
     * @param $id
     * @return array
     */
    public function getEvent($id){
        $event =  \DB::table('events')
            ->join('users','users.id','=','events.owner_id')
            ->select('events.*', 'users.name as owner_name')
            ->where('events.id', '=',(int)$id)
            ->where('events.deleted', '=',0)
            ->first();
        if($event){
            return $event;
        }

        $this->setErrors("Event Not found");

        return [];
    }

    /** set Image to event
     * @param $id
     * @param $image
     * @return bool
     */
    public function setEventImage($id,$image){
        if($event = Event::find($id)){

            $event->image = $image;
            $event->save();

            return true;
        }

        $this->setErrors("Event Not found");

        return false;
    }
}