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

class ProductController extends BaseController
{
    public function index(){
      return Inertia::render('Products/List');
    }

    public function category_index(){
      $categories = Category::all();
      return Inertia::render('Products/Categories/List', ['categories' => $categories]);
    }

    public function category_create(){
      return Inertia::render('Products/Categories/Create');
    }

    public function category_store(Request $request){
      $category = new Category();
      $category->description = $request->description;
      $category->save();
      return redirect()->route('categories')->with('success', 'Categoría creada.');
    }

    public function category_edit(Category $category){
      Log::info($category);
      return Inertia::render('Products/Categories/Edit', ['category' => $category]);
    }

    public function category_update(Request $request, Category $category){
      $category->description = $request->description;
      $category->save();
      return redirect()->route('categories')->with('success', 'Categoría actualizada.');
    }

    public function subcategory_index(){
      return Inertia::render('Products/Subcategories/List');
    }

    public function subcategory_create(){
      return Inertia::render('Products/Subcategories/Create');
    }
}
