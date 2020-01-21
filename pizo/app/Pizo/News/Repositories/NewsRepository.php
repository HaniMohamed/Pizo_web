<?php
/**
 * Created by PhpStorm.
 * User: maxxi
 * Date: 6/15/2018
 * Time: 8:44 PM
 */

namespace App\Pizo\News\Repositories;


use App\Pizo\News\Models\News;
use App\Pizo\Repositories;
use Illuminate\Database\QueryException;

class NewsRepository extends Repositories
{
    private $postId;
    /** add new post
     * @param $data
     * @return bool
     */
    public function createNewPost($data){

        $post = new News();

        $post->title    = $data->title;
        $post->content  = $data->content;
        $post->owner_id = $data->owner_id;

        try{

            if($post->save()){
                $this->postId = $post->id;
                return true;
            }

            $this->setErrors('Can not saved right now');
            return false;

        } catch (QueryException $e){

            $this->setErrors('Query Exception saving post');
            return false;
        }
    }

    /** post Id
     * @return int
     */
    public function getPostId(){
        return $this->postId;
    }

    /** set post image
     * @param $id
     * @param $image
     * @return bool
     */
    public function image($id, $image){
        if(!$post = News::find($id)){
            $this->setErrors('not found');
            return false;
        }

        $post->image = $image;

        return $post->save();

    }

    /** return all news
     * @return array|\Illuminate\Database\Query\Builder[]
     */
    public function all(){
        return \DB::table('news')
            ->join('users','users.id','=','news.owner_id')
            ->select('news.*','users.name')
            ->get();
    }

    /** get post info
     * @param $id
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function post($id){
        return \DB::table('news')
            ->join('users','users.id','=','news.owner_id')
            ->select('news.*','users.name')
            ->where('news.id','=',$id)
            ->first();
    }

    /** delete
     * @param $id
     * @return bool
     */
    public function delete($id){
        return (boolean)News::destroy($id);
    }

}