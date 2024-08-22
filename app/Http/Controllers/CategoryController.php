<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBY('id','desc')->get();
        return view('admin.category.index',compact('categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $categories = new Category;
        $categories->name = $request->name;
        $categories->status = 1;
        $categories->created_at = Carbon::now();
        $categories->save();
        return redirect()->route('category.index')->with('success','Category has been inserted successfully.');
    }


    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('admin.category.edit', compact('categories'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $categories = Category::findOrFail($id);
        $categories->name = $request->name;
        $categories->status = $request->status ? 1 : 0;
        $categories->updated_at = Carbon::now();
        $categories->save();
        return redirect()->route('category.index')->with('success','Category has been updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category has been deleted successfully.');
    }

}
