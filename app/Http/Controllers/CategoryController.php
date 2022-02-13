<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Log;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function index(){
      $categories = Category::orderBy('description')->get();
      return Inertia::render('Products/Categories/List', ['categories' => $categories]);
    }

    public function create(){
      return Inertia::render('Products/Categories/Create');
    }

    public function store(Request $request){
      $category = new Category();
      $category->description = $request->description;
      $category->save();
      return redirect()->route('categories')->with('success', 'Categoría creada.');
    }

    public function edit(Category $category){
      return Inertia::render('Products/Categories/Edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category){
      $category->description = $request->description;
      $category->save();
      return redirect()->route('categories')->with('success', 'Categoría actualizada.');
    }

    public function destroy(Category $category){
      $category->delete();
      return redirect()->route('categories')->with('success', 'Categoría eliminada.');
    }

    public function subcategory_index(){
      return Inertia::render('Products/Subcategories/List');
    }

    public function subcategory_create(){
      return Inertia::render('Products/Subcategories/Create');
    }
}
