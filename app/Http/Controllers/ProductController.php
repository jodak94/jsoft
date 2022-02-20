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
use Storage;
use File;
use DB;

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

    public function store(Request $request){
      try{
        DB::beginTransaction();
        $product = new Product();
        $product->description = $request->description;
        $product->code = $request->code;
        $product->sale_price = $request->sale_price;
        $product->wholesale_price = $request->wholesale_price;
        $product->tax = $request->tax;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        if(isset($request->file)){
          $file = $request->file;
          $ext = $file->getClientOriginalExtension();
          $filename = hash( 'sha256', time()) . '.' . $ext;
          Storage::put('public/' . $filename, file_get_contents($file));
          $product->file_url = $filename;
        }
        $product->save();
        foreach ($request->warehouses as $warehouse) {
          $product->warehouses()->attach($warehouse['id'], $warehouse['pivot']);
        }
        DB::commit();
        return redirect()->route('products')->with('success', 'Producto creado.');
      }catch (Throwable $e) {
            Log::info($e);
            DB::rollback();
            // return false;
      }
    }
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
