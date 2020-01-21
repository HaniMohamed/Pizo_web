<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 5/14/2018
 * Time: 4:06 PM
 */
namespace App\Http\Controllers\Jobs;


use App\Http\Controllers\Controller;
use App\Pizo\Jobs\Services\JobsServices;

class jobsController extends Controller
{
    private $JobsServices;
    public function __construct()
    {

        $this->middleware('jwt.auth',['only'=>[
            'all','get','add','delete'
        ]]);

        $this->middleware('job.owner',['only'=>[
            'delete'
        ]]);

        $this->JobsServices = new JobsServices();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(){
        return $this->JobsServices->allJobs();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(){
        return $this->JobsServices->getJob();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(){
        return $this->JobsServices->addNewJob();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(){
        return $this->JobsServices->deleteJob();
    }
}