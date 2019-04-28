<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $clients = Client::orderBy('id', 'DESC')->paginate(8);
        
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

        $clients = Client::where($query,'like','%' . $queryField . '%')->latest()->paginate(8);

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
        // if(!$request->ajax()) return redirect('/');

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

        ]);
        
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
        // if(!$request->ajax()) return redirect('/');

        $client = Client::findOrFail($request->id);

        $request->validate([
            'name'  => 'required|string',
            'razon_social'  => 'required|string',
            'nickname'  => 'required|string',
            'email'  => 'required|string|email|unique:clients,email,'.$id, 
            'birth_date' => 'required|date_format:Y-m-d',
            'reference'     => 'nullable|max:100',
            'cp'  => 'required',
            'cuit'  => 'required',
            'tax'  => 'required|numeric|min:0',
        ]);

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
