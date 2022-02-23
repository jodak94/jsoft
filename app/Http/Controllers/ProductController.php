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
    public function index(Request $request){
      $products = Product::select();
      if(isset($request->searchFilter) && trim($request->searchFilter) != ''){
        $products->where('description', 'like',  '%' . $request->searchFilter . '%')
                 ->orWhere('code', 'like', '%' . $request->searchFilter . '%');
      }
      $products = $products->orderBy('description')->get();
      return Inertia::render('Products/List', ['products' => $products]);
    }

    public function create(){
      return Inertia::render('Products/Create', [
        'categories' => Category::select('id', 'description')->orderBy('description')->get(),
        'warehouses' => Warehouse::select('id', 'name')->get()
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
          $file_name = hash( 'sha256', time()) . '.' . $ext;
          Storage::put($file_name, file_get_contents($file));
          $product->file_name = $file_name;
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
            return false;
      }
    }

    public function warehousesData(Product $product){
      return response()->json(['error' => false, 'warehouses' => $product->warehouses]);
    }

    public function edit(Product $product){
      return Inertia::render('Products/Edit', [
        'product' => $product,
        'categories' => Category::select('id', 'description')->orderBy('description')->get(),
        'subcategories' => Subcategory::select('id', 'description')->where('category_id', $product->category_id)->orderBy('description')->get()
      ]);
    }

    public function update(Request $request, Product $product){
      try{
        DB::beginTransaction();
        $product->description = $request->description;
        $product->code = $request->code;
        $product->sale_price = $request->sale_price;
        $product->wholesale_price = $request->wholesale_price;
        $product->tax = $request->tax;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        if($request->file_changed){
          Storage::delete($product->file_name);
          if(isset($request->file)){
            $file = $request->file;
            $ext = $file->getClientOriginalExtension();
            $file_name = hash( 'sha256', time()) . '.' . $ext;
            Storage::put($file_name, file_get_contents($file));
            $product->file_name = $file_name;
          }else{
            $product->file_name = null;
          }
        }
        $product->save();
        foreach ($request->warehouses as $warehouse) {
          $product->warehouses()->updateExistingPivot($warehouse, [
            'stock' => $warehouse['pivot']['stock'],
            'critical_stock' => $warehouse['pivot']['critical_stock'],
          ]);
        }
        DB::commit();
        return redirect()->route('products')->with('success', 'Producto actualizada.');
      }catch (Throwable $e) {
          Log::info($e);
          DB::rollback();
          return false;
      }
    }

    public function destroy(Product $product){
      Storage::delete($product->file_name);
      $product->delete();
      return redirect()->route('products')->with('success', 'Producto eliminada.');
    }
}
