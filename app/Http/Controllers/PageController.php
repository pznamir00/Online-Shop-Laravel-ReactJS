<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\SubCategory;
use Illuminate\Support\Facades\DB;


class PageController extends Controller
{
    private $default_paginate = 20;



    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate($this->default_paginate);
        $categories = Category::all();
        return view('pages.index', compact('products', 'categories'));
    }

    public function one_product($id)
    {
        $product = Product::find($id);
        $subcat = SubCategory::find($product->category_id);
        $category = Category::find($subcat->base_category_id);
        return view('pages.one_product', compact('product', 'category', 'subcat'));
    }

    public function categories($cat, $subcat)
    {
        $subcat_id = SubCategory::where('slug', '=', $subcat)->pluck('id');
        $products = Product::where('category_id', '=', $subcat_id)->orderBy('id', 'DESC')->paginate($this->default_paginate);
        $categories = Category::all();
        return view('pages.index', compact('products', 'categories'));
    }

    public function keywords()
    {
        if(!request()->has('keywords') || request('keywords') == '')
          return redirect('/');
        $keywords = request('keywords');
        $products = Product::where('title', 'like', '%'.$keywords.'%')->orWhere('description', 'like', '%'.$keywords.'%')->orderBy('id', 'DESC')->paginate($this->default_paginate);
        $categories = Category::all();
        return view('pages.index', compact('products', 'categories'));
    }
}
                                                                                                                                                                                  
