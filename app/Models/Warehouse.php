<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';
    protected $fillable = ['description'];

    public function products(){
      return $this->hasMany('App\Models\Product', 'product_warehouse');
    }
}
