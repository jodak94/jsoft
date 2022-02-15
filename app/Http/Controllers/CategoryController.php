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
    public function index(Request $request){
      $categories = Category::select();
      if(isset($request->description) && trim($request->description) != '')
        $categories->where('description', 'like', '%'.$request->description.'%');
      $categories = $categories->orderBy('description')->get();
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

    public function subcategories(Category $category){
      Log::info($category->description);
      return response()->json(['subcategories' => $category->subcategories]);
    }
}
