<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Log;
use App\Models\Client;

class ClientController extends BaseController
{
    public function index(Request $request){
      $clients = Client::select();
      if(isset($request->searchFilter) && trim($request->searchFilter) != ''){
        $clients->where('name', 'like',  '%' . $request->searchFilter . '%')
                 ->orWhere('business_name', 'like', '%' . $request->searchFilter . '%')
                 ->orWhere('ruc', 'like', '%' . $request->searchFilter . '%');
      }
      $clients = $clients->orderBy('ruc')->get();
      return Inertia::render('Clients/List', ['clients' => $clients]);
    }

    public function create(){
      return Inertia::render('Clients/Create');
    }

    public function store(Request $request){
      $client = new Client();
      $client->name = $request->name;
      $client->business_name = $request->business_name;
      $client->ruc = $request->ruc;
      $client->phone = $request->phone;
      $client->address = $request->address;
      $client->save();
      return redirect()->route('clients')->with('success', 'Cliente creado.');
    }

    public function edit(Client $client){
      return Inertia::render('Clients/Edit', ['client' => $client]);
    }

    public function update(Request $request, Client $client){
      $client->name = $request->name;
      $client->business_name = $request->business_name;
      $client->ruc = $request->ruc;
      $client->phone = $request->phone;
      $client->address = $request->address;
      $client->save();
      return redirect()->route('clients')->with('success', 'Cliente actualizado.');
    }

    public function destroy(Client $client){
      $client->delete();
      return redirect()->route('clients')->with('success', 'Cliente eliminado.');
    }

}
