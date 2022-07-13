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
        return \redirect('admin/post');

    }
    public function post_detail($id){
        $dataPost = Post::find($id);
        return view("post_detail")->with('dataPost',$dataPost);
    }
    public function post_delete($id){
        Post::find($id)->delete();
        return \redirect('admin/post');
    }
    public function post_form_edit($id){
        $dataPost = Post::find($id);
        $dataCategory = Category::select('id','title')->orderBy('id', 'ASC')->get();
        return view('admin.post_update')->with('action','post')->with('dataPost',$dataPost)->with('dataCategory',$dataCategory);
    }
    public function post_update(Request $request){
        Post::where('id',$request->id)->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'idCategory' => $request->idCategory,
            'status' => $request->status
        ]);
        return \redirect('admin/post');
    }
}
