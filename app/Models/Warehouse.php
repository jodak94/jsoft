<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';
    public $translatedAttributes = [];
    protected $fillable = ['description'];

}