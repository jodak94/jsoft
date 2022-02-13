<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Log;
use App\Models\Subcategory;

class SubcategoryController extends BaseController
{
    public function index(Request $request){
      $subcategories = Subcategory::select();
      if(isset($request->description) && trim($request->description) != '')
        $subcategories->where('description', 'like', '%'.$request->description.'%');
      $subcategories = $subcategories->orderBy('description')->get();
      return Inertia::render('Products/Subcategories/List', ['subcategories' => $subcategories]);
    }

    public function create(){
      return Inertia::render('Products/Subcategories/Create');
    }

    public function store(Request $request){
      $subcategory = new Subcategory();
      $subcategory->description = $request->description;
      $subcategory->save();
      return redirect()->route('subcategories')->with('success', 'Subcategoría creada.');
    }

    public function edit(Subcategory $subcategory){
      return Inertia::render('Products/Subcategories/Edit', ['category' => $subcategory]);
    }

    public function update(Request $request, Subcategory $category){
      $subcategory->description = $request->description;
      $subcategory->save();
      return redirect()->route('subcategories')->with('success', 'Subcategoría actualizada.');
    }

    public function destroy(Subcategory $subcategory){
      $subcategory->delete();
      return redirect()->route('subcategories')->with('success', 'Subcategoría eliminada.');
    }
}
