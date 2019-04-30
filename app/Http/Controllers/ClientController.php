<?php

namespace App\Http\Controllers;

use App\Client;
use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  

class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $clients = Client::join('addresses','addresses.client_id','clients.id')
                ->select('clients.*','addresses.*')
                ->orderBy('clients.id', 'asc')
                ->withTrashed()
                ->paginate(8);      
        
        return [
            'pagination' => [
                'total'         => $clients->total(),
                'current_page'  => $clients->currentPage(),
                'per_page'      => $clients->perPage(),
                'last_page'     => $clients->lastPage(),
                'from'          => $clients->firstItem(),
                'to'            => $clients->lastItem(),
            ],
         'clients' => $clients
        ];
    }

    public function search($query, $queryField)
    {

        $clients = Client::join('addresses','addresses.client_id','client.id')
                ->select('clients.*','addresses.*')
                ->where($query,'like','%' . $queryField . '%')->latest()
                ->orderBy('clients.id', 'DESC')
                ->withTrashed()
                ->paginate(8);

        return compact('clients');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(!$request->ajax()) return redirect('/');

        $counter = Client::all()->count();
        $counter = $counter + 1;
        $code = str_pad($counter,6,"0",STR_PAD_LEFT);

        return compact('code');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $request->validate([
            'name'  => 'required|string',
            'razon_social'  => 'required|string',
            'nickname'  => 'required|string',
            'email'  => 'required|string|email|unique:clients',
            'birth_date' => 'required|date_format:Y-m-d',
            'reference'     => 'nullable|max:100',
            'cp'  => 'required',
            'cuit'  => 'required',
            'tax'  => 'required|numeric|min:0',
            'address'  => 'required|string',
        ]);

        try{
                DB::beginTransaction();
                $client = new Client();
                $client->code = $request->code;
                $client->name = $request->name;
                $client->razon_social = $request->razon_social;
                $client->nickname = $request->nickname;
                $client->email = $request->email;
                $client->birth_date = $request->birth_date;
                $client->reference = $request->reference;
                $client->cp = $request->cp;
                $client->cuit = $request->cuit;
                $client->tax = $request->tax;
                $client->save();

                $address = new Address();
                $address->client_id = $client->id;
                $address->address = $request->address;
                $address->locality = $request->locality;
                $address->province = $request->province;
                $address->phone_number = $request->phone_number;
                $address->nextel_number = $request->nextel_number;
                $address->cell_number = $request->cell_number;
                $address->save();
            
            DB::commit();

        }catch(Execption $e){
            DB::rollBack();
        }
        
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        if(!$request->ajax()) return redirect('/');

        $client = Client::findOrFail($request->id);
        $client_id = $client->id;
        $address = Address::findOrfail($client_id);

        $request->validate([
            'name'  => 'required|string',
            'razon_social'  => 'required|string',
            'nickname'  => 'required|string',
            'email'  => 'required|string|email|unique:clients,email,'.$client->id, 
            'birth_date' => 'required|date_format:Y-m-d',
            'reference'     => 'nullable|max:100',
            'cp'  => 'required',
            'cuit'  => 'required',
            'tax'  => 'required|numeric|min:0',
        ]);

        try{

            DB::beginTransaction();
            $client->code = $request->code;
            $client->name = $request->name;
            $client->razon_social = $request->razon_social;
            $client->nickname = $request->nickname;
            $client->email = $request->email;
            $client->birth_date = $request->birth_date;
            $client->reference = $request->reference;
            $client->cp = $request->cp;
            $client->cuit = $request->cuit;
            $client->tax = $request->tax;
            $client->save();

            $address->client_id = $address->client_id;
            $address->address = $request->address;
            $address->locality = $request->locality;
            $address->province = $request->province;
            $address->phone_number = $request->phone_number;
            $address->nextel_number = $request->nextel_number;
            $address->cell_number = $request->cell_number;
            $address->save();

            DB::commit();

        }catch(Execption $e){
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
    }
    
    public function restore(Request $request, $id)
    {
        $client_id = $id;

        $client = Client::withTrashed($id)
                ->restore();

        $address = Address::withTrashed($client_id)
                ->restore();
                
    }
}
