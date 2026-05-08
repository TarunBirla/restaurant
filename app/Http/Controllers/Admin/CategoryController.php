<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();

        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $image = null;

        if($request->hasFile('image')){
            $image = $request->file('image')
                ->store('categories','public');
        }

        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'image' => $image,
            'status' => 1
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success','Category Added');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $categories = Category::whereNull('parent_id')
            ->where('id','!=',$id)
            ->get();

        return view('admin.categories.edit',
            compact('category','categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $image = $category->image;

        if($request->hasFile('image')){
            $image = $request->file('image')
                ->store('categories','public');
        }

        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'image' => $image
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success','Category Updated');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return back()->with('success','Deleted');
    }
}