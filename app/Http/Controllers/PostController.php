<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Link;

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
        return view("admin.post")->with('action','post')->with('dataCategory',$dataCategory);
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
}
