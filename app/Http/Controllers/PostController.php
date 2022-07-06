<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Link;

use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCategory = Category::select('id','title')->orderBy('id', 'ASC')->get();
        $dataPost = Post::join('category','post.idCategory','=','category.id')->orderBy('post.id', 'ASC')->select('post.*','category.title as titleCategory')->paginate(10);
        return view("admin.post")->with('action','post')->with('dataCategory',$dataCategory)->with('dataPost',$dataPost);
    }

    public function crawl()
    {
        $url ="";
        $bot = new \App\Scraper\TienPhongNews();
        $bot->scrape($url);
    }
    public function post_crawl(Request $request){
        dd($request->idCategory);
    }
    public function post_crawlById($id){
        $bot = new \App\Scraper\TienPhongNews();
        $bot->scrape($id);
        return \redirect('post');

    }
    public function post_detail($id){
        $dataPost = Post::find($id);
        return view("post_detail")->with('dataPost',$dataPost);
    }
}
