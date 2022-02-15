<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $translatedAttributes = [];
    protected $fillable = ['description'];

    public function subcategories(){
      return $this->hasOne('App\Models\Subcategory');
    }

    public function categories(){
      return $this->hasOne('App\Models\Category');
    }

    public function warehouses(){
      return $this->hasMany('App\Models\Warehouse');
    }
}
