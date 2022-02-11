<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategorie extends Model
{
    protected $table = 'subcategories';
    public $translatedAttributes = [];
    protected $fillable = ['description', 'categorie_id'];

    public function categorie(){
      return $this->belongsTo('App\Models\Category');
    }
}
