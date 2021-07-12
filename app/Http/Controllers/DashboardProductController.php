<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductRequest;
use App\ProductGallery;
use Illuminate\Support\Facades\Auth;

class DashboardProductController extends Controller
{
    public function index(){
        $products = Product::with(['galleries','category'])->where('users_id',Auth::user()->id)->get();
        return view('pages.dashboard-product',[
            'products'  => $products
        ]);
    }

    public function detail($id){
        $product = Product::with(['galleries','user','category'])->findOrFail($id);
        $categories = Category::all();
        return view('pages.dashboard-product-detail',[
            'product'   => $product,
            'categories'    => $categories
        ]);
    }

    public function add(){
        $categories = Category::all();
        return view('pages.dashboard-product-add',[
            'categories' => $categories
        ]);
    }

    public function uploadGallery(Request $request){
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product','public');
        ProductGallery::create($data);
        return redirect()->route('dashboard-product-detail',$request->products_id);
    }

    public function deleteGallery(Request $request,$id){
        $item = ProductGallery::findOrFail($id);
        $item->delete();
        return redirect()->route('dashboard-product-detail',$item->products_id);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $item = Product::findOrFail($id);
        $data['slug'] = Str::slug($request->name);
        $item->update($data);
        return redirect()->route('dashboard-product');
    }

    
    public function store(ProductRequest $request)
        {
            // dd($request);
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);
        $gallery = [
            'products_id'   => $product->id,
            'photos'        => $request->file('photo')->store('assets/product','public'),
            ];
        ProductGallery::create($gallery);
        return redirect()->route('dashboard-product');
        }


    public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('pages.dashboard-product-edit',[
            'product' => $product,
            'categories'    => $categories
        ]);
    }
}
