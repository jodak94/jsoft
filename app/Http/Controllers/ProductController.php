<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
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
      Log::info($categories);
      return Inertia::render('Products/Categories/List', ['categories' => $categories]);
    }

    public function category_create(){
      return Inertia::render('Products/Categories/Create');
    }

    public function subcategory_index(){
      return Inertia::render('Products/Subcategories/List');
    }

    public function subcategory_create(){
      return Inertia::render('Products/Subcategories/Create');
    }
}
