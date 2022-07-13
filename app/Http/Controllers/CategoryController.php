<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCategory = Category::orderBy('id', 'ASC')->paginate(10);
        // dd($dataCategory);
        return view('admin.category')->with('dataCategory',$dataCategory)->with('action','category');
    }
    public function category_update()
    {
        $bot = new \App\Scraper\TienPhongNews();
        $bot->getCategory();
        return redirect('admin/category');
    }
}
