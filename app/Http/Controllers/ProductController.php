<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBY('id','desc')->get();
        return view('admin.product.index',compact('products'));
    }

    public function create()
    {
        $products = Product::all();
        $categories = Category::latest()->get();
        return view('admin.product.create', compact('products', 'categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $products = new Product;
        $products->name = $request->name;
        $products->category_id = $request->category_id;
        $products->model_no = $request->model_no;
        $products->price = $request->price;
        $products->qty = $request->qty;
        $products->warranty = $request->warranty;
        $products->purchase_date = $request->purchase_date;
        $products->note = $request->note;
        $products->status = 1;
        $products->created_at = Carbon::now();
        $products->save();
        return redirect()->route('product.index')->with('success','Product has been inserted successfully.');
    }


    public function edit($id)
    {
        $products = Product::findOrFail($id);
        $categories = Category::latest()->get();
        return view('admin.product.edit', compact('products', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $products = Product::findOrFail($id);
        $products->name = $request->name;
        $products->category_id = $request->category_id;
        $products->model_no = $request->model_no;
        $products->price = $request->price;
        $products->qty = $request->qty;
        $products->warranty = $request->warranty;
        $products->purchase_date = $request->purchase_date;
        $products->note = $request->note;
        $products->status = $request->status ? 1 : 0;
        $products->updated_at = Carbon::now();
        $products->save();
        return redirect()->route('product.index')->with('success','Product has been updated successfully.');
    }


    public function destroy($id)
    {
        $products = Product::findOrFail($id);
        $products->delete();
        return redirect()->route('product.index')->with('success', 'Product has been deleted successfully.');
    }
}
