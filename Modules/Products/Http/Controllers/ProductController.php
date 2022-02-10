<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class ProductController extends BaseController
{
    public function index(){
      return Inertia::render('Products.List');
    }
}
