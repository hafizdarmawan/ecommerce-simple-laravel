<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\Admin\CategoryRequest;
use App\Product;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::take(6)->get(); 
        $products   = Product::with('galleries')->paginate(10);
        return view('pages.category',[
            'categories'=> $categories,
            'products'  => $products
        ]);
    }
    
    public function detail(Request $request, $slug){
        $categories = Category::all(); 
        $category = Category::where('slug',$slug)->firstOrFail();
        $products   = Product::with('galleries')->where('categories_id',$category->id)->paginate(10);
        return view('pages.category',[
            'categories'=> $categories,
            'products'  => $products
        ]);
    }
}
