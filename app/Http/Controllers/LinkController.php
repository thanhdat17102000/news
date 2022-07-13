<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Link;

class LinkController extends Controller
{
    public function index(){
        $dataCategory = Category::select('id','title')->orderBy('id', 'ASC')->get();
        $dataLink = Link::join('category','link.idCategory','=','category.id')
        ->select('link.id','link','category.title','link.statusCrawl')
        ->paginate(10);
        return view('admin.link')->with('action','link')->with('dataCategory',$dataCategory)->with('dataLink',$dataLink);
    }
    public function link_crawl(Request $request){
        $bot = new \App\Scraper\TienPhongNews();
        $bot->getLinkByCategory($request->idCategory);
        return redirect('admin/link');
    }
}
