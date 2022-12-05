<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category', ['categories' => $categories]);
    }
    public function add()
    {
        return view('category-add');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);

        $category = Category::create($request->all());
        Session::flash('status', 'success');
        Session::flash('message', 'Add category success!');
        return redirect('/categories');
    }
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('category-edit', ['category' => $category]);
    }
    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $category->update($request->all());
        Session::flash('status', 'success');
        Session::flash('message', 'Edit category success!');
        return redirect('/categories');
    }
    public function delete($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('category-delete', ['category' => $category]);
    }
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();
        Session::flash('status', 'danger');
        Session::flash('message', 'Delete category success!');
        return redirect('/categories');
    }
    public function deletedCategory()
    {
        $deletedCategory = Category::onlyTrashed()->get();
        return view('category-deleted-list', ['deletedCategory' => $deletedCategory]);
    }
    public function restore($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $category->restore();
        Session::flash('status', 'success');
        Session::flash('message', 'Restore category success!');
        return redirect('/categories');
    }
}
