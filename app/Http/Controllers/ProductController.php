<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Log;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Warehouse;

class ProductController extends BaseController
{
    public function index(){
      $products = Product::select();
      if(isset($request->description) && trim($request->description) != '')
        $products->where('description', 'like', '%'.$request->description.'%');
      $products = $products->orderBy('description')->get();
      return Inertia::render('Products/List', ['products' => $products]);
    }

    public function create(){
      return Inertia::render('Products/Create', [
        'categories' => Category::select('id', 'description')->orderBy('description')->get(),
        'warehouses' => Warehouse::select('id', 'name')->get(),
      ]);
    }

    // public function store(Request $request){
    //   $category = new Category();
    //   $category->description = $request->description;
    //   $category->save();
    //   return redirect()->route('categories')->with('success', 'Categoría creada.');
    // }
    //
    // public function edit(Category $category){
    //   return Inertia::render('Products/Categories/Edit', ['category' => $category]);
    // }
    //
    // public function update(Request $request, Category $category){
    //   $category->description = $request->description;
    //   $category->save();
    //   return redirect()->route('categories')->with('success', 'Categoría actualizada.');
    // }
    //
    // public function destroy(Category $category){
    //   $category->delete();
    //   return redirect()->route('categories')->with('success', 'Categoría eliminada.');
    // }
}
