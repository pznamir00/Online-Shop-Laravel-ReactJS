<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use App\Product;
use App\Category;
use App\SubCategory;
use Illuminate\Support\Facades\DB;


class PageController extends Controller
{
    private $default_paginate = 20;



    public function index()
    {
        $products = Product::where('active', '=', '1')->orderBy('id', 'DESC')->paginate($this->default_paginate);
        $categories = Category::all();
        return view('pages.index', compact('products', 'categories'));
    }

    public function one_product($id)
    {
        try{
          $product = Product::find($id);
          $subcat = SubCategory::find($product->category_id);
          $category = Category::find($subcat->base_category_id);
          return view('pages.one_product', compact('product', 'category', 'subcat'));
        }
        catch(QueryException $e){
          return redirect('/')->withErrors('Product not found');
        }
    }

    public function categories($cat, $subcat)
    {
        try{
            $subcat_id = SubCategory::where('slug', '=', $subcat)->pluck('id');
            $products = Product::where('active', '=', '1')->where('category_id', '=', $subcat_id)->orderBy('id', 'DESC')->paginate($this->default_paginate);
            $categories = Category::all();
            return view('pages.index', compact('products', 'categories'));
        }
        catch(QueryException $e){
          return redirect('/')->withErrors('Categories not found');
        }
    }

    public function keywords()
    {
        if(!request()->has('keywords') || request('keywords') == '')
          return redirect('/');
        $keywords = request('keywords');
        $products = Product::where('active', '=', '1')->where('title', 'like', '%'.$keywords.'%')->orWhere('description', 'like', '%'.$keywords.'%')->orderBy('id', 'DESC')->paginate($this->default_paginate);
        $categories = Category::all();
        return view('pages.index', compact('products', 'categories'));
    }
}
                                                                                                                                                                                  
