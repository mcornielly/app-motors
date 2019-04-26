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
    public function index()
    {
        $clients = Client::orderBy('id', 'DESC')->get();

        return $clients;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $request->validate([
            'code'  => 'required|unique:clients',
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
        $client = Client::findOrFail($client->id);
        $client->code = $request->code;
        $client->name = $request->name;
        $client->rason_social = $request->rason_social;
        $client->nickaname = $request->nickaname;
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
