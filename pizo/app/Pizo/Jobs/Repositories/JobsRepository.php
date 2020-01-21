<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 5/14/2018
 * Time: 2:39 PM
 */

namespace App\Pizo\Jobs\Repositories;


use App\Jobs\Job;
use App\Pizo\Jobs\Models\Jobs;
use App\Pizo\Repositories;
use Illuminate\Database\QueryException;

class JobsRepository extends Repositories
{
    private $id = 0;
    /** get jobs
     * @return Jobs[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get(){
        return \DB::table('jobs')
            ->join('users','users.id','=','jobs.owner_id')
            ->select('jobs.*', 'users.name as owner_name')
            ->where('jobs.deleted','=',0)
            ->get();
    }

    /** get a job by id
     * @param $id
     * @return bool
     */
    public function getById($id){
        $job = \DB::table('jobs')
            ->join('users','users.id','=','jobs.owner_id')
            ->select('jobs.*', 'users.name as owner_name')
            ->where('jobs.id', '=',(int)$id)
            ->first();

        if($job){
            if($job->deleted == 0) {
                return $job;
            } else {
               $this->setErrors('No Permissions');
                return [];
            }
        }

        $this->setErrors('Invalid Job Id');
        return [];
    }

    /** add new job
     * @param $data
     * @return bool
     */
    public function add($data){
        $job = new Jobs();

        $job->title         = $data->title;
        $job->description   = $data->description;
        $job->owner_id      = $data->owner_id;
        $job->category_id   = $data->category_id;
        $job->featured      = $data->featured;
        $job->deleted       = $data->deleted;

        try{
            if($job->save()) {
                $this->id = $job->id;
                return true;
            }

            $this->setErrors('Job cant be saved');
            return false;
        } catch (QueryException $e){

            $this->setErrors('Query Exception');
            return false;
        }

    }

    /** deleted job
     * @param $id
     * @return bool
     */
    public function delete($id){
        if($job = Jobs::find((int)$id)){
            $job->deleted = 1;

            try{
                if($job->save())
                    return true;

                $this->setErrors('Job cant be deleted');
                return false;
            } catch (QueryException $e){

                $this->setErrors('Query Exception');
                return false;
            }
        }

        $this->setErrors('Not Found');
        return false;
    }

    /** get job id
     * @return int
     */
    public function getId(){
        return $this->id;
    }

}