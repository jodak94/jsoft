<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['description'];

    public function subcategories(){
      return $this->hasMany('App\Models\Subcategory');
    }

    public function products(){
      return $this->hasMany('App\Models\Product');
    }
}
