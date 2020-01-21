<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 5/14/2018
 * Time: 2:59 PM
 */

namespace App\Pizo\Jobs\Services;

use App\Pizo\Jobs\Repositories\JobsRepository;
use App\Pizo\Services;
use Illuminate\Support\Facades\Input;

class JobsServices extends Services
{
    Private $jobRepo;

    public function __construct(){
        $this->jobRepo = new JobsRepository();
    }

    /** add job
     * @return \Illuminate\Http\JsonResponse
     */
    public function addNewJob(){
        $rules = [
            'title'         => 'required|max:150',
            'description'   => 'max:3700',
            'category_id'   => 'required|int'
        ];

        $validator = \Validator::make(Input::all(), $rules);

        if($validator->passes()){
            $data = new \stdClass();

            $data->title        = $this->xss_clean(Input::get('title'));
            $data->description  = $this->xss_clean(Input::get('description'));
            $data->category_id  = (int)Input::get('category_id');
            $data->owner_id     = (int) \Auth::id();
            $data->featured     = 0;
            $data->deleted      = 0;

            if($this->jobRepo->add($data)){
                $res = [
                    'msg' => 'Job has been added',
                    'id'  => $this->jobRepo->getId(),
                    "error" => '0'
                ];

                return response()->json($res, 200);

            } else {

                $res = [
                    'msg' => $this->jobRepo->setErrors()[0],
                    "error" => '1'
                ];

                return response()->json($res, 200);

            }

        }
        else{

            $res = [
                'msg' => $validator->errors()->all()[0],
                "error" => '1'
            ];

            return response()->json($res, 200);
        }
    }

    /** get job by id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJob()
    {
        if (!$id = request()->route('id')) {
            $res = [
                'msg' => 'Invalid Request',
                "error" => '1'
            ];

            return response()->json($res, 200);
        }

        if (!$job = $this->jobRepo->getById($id)) {
            $res = [
                'msg' => $this->jobRepo->getErrors()[0],
                "error" => '1'
            ];

            return response()->json($res, 200);
        } else {
            $res = [
                'msg'   => 'Job Found',
                'job'   => $job,
                "error" => '0'
            ];

            return response()->json($res, 200);
        }
    }

    /**get all jobs
     * @return \Illuminate\Http\JsonResponse
     */
    public function allJobs(){
        $jobs = $this->jobRepo->get();

        $res = [
            'msg'   => 'Jobs',
            'jobs'   => $jobs,
            "error" => '0'
        ];

        return response()->json($res, 200);
    }

    /** delete Job
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteJob(){
        if (!$id = (int)request()->route('id')) {
            $res = [
                'msg' => 'Invalid Request',
                "error" => '1'
            ];
            return response()->json($res, 200);
        }

        if($this->jobRepo->delete((int)$id)){
            $res = [
                'msg' => 'Job has been deleted',
                "error" => '0'
            ];
            return response()->json($res, 200);

        } else {

            $res = [
                'msg' => $this->jobRepo->getErrors()[0],
                "error" => '0'
            ];
            return response()->json($res, 200);

        }
    }
}