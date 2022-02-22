<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $translatedAttributes = [];
    protected $fillable = ['description'];
    protected $appends = ['category_desc', 'subcategory_desc', 'total_stock', 'image_url'];

    public function subcategory(){
      return $this->belongsTo('App\Models\Subcategory');
    }

    public function category(){
      return $this->belongsTo('App\Models\Category');
    }

    public function warehouses(){
      return $this->belongsToMany('App\Models\Warehouse', 'product_warehouse')->withPivot('stock', 'critical_stock');
    }

    public function getCategoryDescAttribute(){
      return $this->category == null ? '---' : $this->subcategory->description;;
    }

    public function getSubcategoryDescAttribute(){
      return $this->subcategory == null ? '---' : $this->subcategory->description;
    }

    public function getTotalStockAttribute(){
      return $this->warehouses->sum('pivot.stock');
    }

    public function getImageUrlAttribute(){
      return asset('/storage/' . $this->attributes['file_url']);
    }
}
