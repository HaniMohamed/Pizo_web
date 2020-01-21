<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 6/15/2018
 * Time: 8:35 PM
 */

namespace App\Http\Controllers\News;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pizo\News\Services\NewsService;

class NewsController extends Controller
{
    private $newsService;
    public function __construct()
    {
        $this->middleware('jwt.auth');
        $this->middleware('admin', ['only' => ['add','delete','image','update']]);

        $this->newsService = new NewsService();
    }

    /**add new post
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(){
        return $this->newsService->newPost();
    }

    public function post($id){
        return $this->newsService->postInfo($id);
    }
    /** get all posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(){
        return $this->newsService->getAllPosted();
    }

    /** set image
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function image(Request $request){
        return $this->newsService->setImage($request);
    }

    /** delete post
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){
        return $this->newsService->delete($id);

    }
}