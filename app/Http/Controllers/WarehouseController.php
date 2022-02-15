<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Log;
use App\Models\Warehouse;

class WarehouseController extends BaseController
{
    public function index(Request $request){
      $warehouses = Warehouse::select();
      if(isset($request->description) && trim($request->description) != '')
        $warehouses->where('description', 'like', '%'.$request->description.'%');
      $warehouses = $warehouses->orderBy('description')->get();
      return Inertia::render('Warehouses/List', ['warehouses' => $warehouses]);
    }

    public function create(){
      return Inertia::render('Warehouses/Create');
    }

    public function store(Request $request){
      $warehouse = new Warehouse();
      $warehouse->name = $request->name;
      $warehouse->description = $request->description;
      $warehouse->save();
      return redirect()->route('warehouses')->with('success', 'Depósito creado.');
    }

    public function edit(Warehouse $warehouse){
      return Inertia::render('Warehouses/Edit', ['warehouse' => $warehouse]);
    }

    public function update(Request $request, Warehouse $warehouse){
      $warehouse->name = $request->name;
      $warehouse->description = $request->description;
      $warehouse->save();
      return redirect()->route('warehouses')->with('success', 'Depósito actualizada.');
    }

    public function destroy(Warehouse $warehouse){
      $warehouse->delete();
      return redirect()->route('warehouses')->with('success', 'Depósito eliminada.');
    }
}
