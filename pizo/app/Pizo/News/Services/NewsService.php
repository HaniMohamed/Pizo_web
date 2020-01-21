<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 6/15/2018
 * Time: 9:14 PM
 */
namespace App\Pizo\News\Services;


use App\Pizo\News\Repositories\NewsRepository;
use App\Pizo\Services;
use Illuminate\Support\Facades\Input;

class  NewsService extends Services
{
    private $newsRepo;

    public function __construct()
    {
        $this->newsRepo = new NewsRepository();
    }

    public function newPost(){
        $rules = [
            'title'     => 'required|min:1',
            'content'   => 'required|min:1'
        ];

        $validator = \Validator::make(Input::all(),$rules);

        if ($validator->passes()){

            $post = new \stdClass();

            $post->title    = $this->xss_clean(Input::get('title'));
            $post->content  = $this->xss_clean(Input::get('content'));
            $post->owner_id = \Auth::id();

            if($this->newsRepo->createNewPost($post)){

                $res = [
                    'msg' => 'Post Created',
                    'error'=>0
                ];

                return response()->json($res,200);

            } else {

                $res = [
                    'msg' => $this->newsRepo->getErrors()[0],
                    'error'=>1
                ];

                return response()->json($res,200);
            }

        } else {

            $res = [
                'msg' => $validator->errors()->all()[0],
                'error'=>1
            ];
            return response()->json($res,200);
        }
    }

    /** get image
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setImage($request){

        $rules = [
            'image' => 'required|image'
        ];

        $validation = \Validator::make(Input::all(), $rules);
        if ($validation->passes()) {
            $file = $request->file('image');
            //Move Uploaded File
            $destinationPath = 'uploads/News';
            $new_name = sha1(date("D M j G:i:s.u T Y")) . ".png";

            $image = $file->move($destinationPath, $new_name);

            $post_id = request()->route('id');

            if ($this->newsRepo->image($post_id, $image))
                return response()->json(['msg' => "Image Uploaded", "error" => '0'], 200);

            return response()->json(['msg' => $this->newsRepo->getErrors()[0], "error" => '1'], 200);

        } else {
            $this->setErrors($validation->errors()->all()[0]);
            return response()->json(['msg' => $this->getErrors()[0], "error" => '1'], 200);
        }
    }

    /** get all posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPosted(){
        $posts = $this->newsRepo->all();
        $res = [
            'msg' => count($posts).' Posts',
            'posts' => $posts,
            'error'=>0
        ];
        return response()->json($res,200);
    }

    public function postInfo($id){
        if($post = $this->newsRepo->post($id)){
            $res = [
                'msg' => 'Posts',
                'post' => $post,
                'error'=>0
            ];
            return response()->json($res,200);
        } else {
            $res = [
                'msg' => 'Not Found',
                'error'=>1
            ];
            return response()->json($res,200);
        }
    }

    /** delete post
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){
        if($this->newsRepo->delete($id))
            return response()->json([
                'msg' => 'Post deleted',
                'error'=>0
            ],200);

        return response()->json([
            'msg' => 'Not Found',
            'error'=>1
        ],200);

    }
}