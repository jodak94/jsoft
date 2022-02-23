<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Log;
use App\Models\Provider;

class ProviderController extends BaseController
{
    public function index(Request $request){
      $providers = Provider::select();
      if(isset($request->searchFilter) && trim($request->searchFilter) != ''){
        $providers->where('name', 'like',  '%' . $request->searchFilter . '%')
                 ->orWhere('business_name', 'like', '%' . $request->searchFilter . '%')
                 ->orWhere('ruc', 'like', '%' . $request->searchFilter . '%');
      }
      $providers = $providers->orderBy('ruc')->get();
      // dd($providers);
      return Inertia::render('Providers/List', ['providers' => $providers]);
    }

    public function create(){
      return Inertia::render('Providers/Create');
    }

    public function store(Request $request){
      $provider = new Provider();
      $provider->name = $request->name;
      $provider->business_name = $request->business_name;
      $provider->ruc = $request->ruc;
      $provider->phone = $request->phone;
      $provider->address = $request->address;
      $provider->save();
      return redirect()->route('providers')->with('success', 'Proveedor creado.');
    }

    public function edit(Provider $provider){
      return Inertia::render('Providers/Edit', ['provider' => $provider]);
    }

    public function update(Request $request, Provider $provider){
      $provider->name = $request->name;
      $provider->business_name = $request->business_name;
      $provider->ruc = $request->ruc;
      $provider->phone = $request->phone;
      $provider->address = $request->address;
      $provider->save();
      return redirect()->route('providers')->with('success', 'Proveedor actualizado.');
    }

    public function destroy(Provider $provider){
      $provider->delete();
      return redirect()->route('providers')->with('success', 'Proveedor eliminado.');
    }

}
