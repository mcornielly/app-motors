<?php

namespace App\Http\Controllers;

use App\Address;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  


class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!$request->ajax()) return redirect('/');

        $addresses = Address::join('clients','clients.id','addresses.client_id')
                ->select('clients.*','addresses.*')
                ->orderBy('clients.id', 'asc')
                ->withTrashed()
                ->paginate(8);      
        
        return [
            'pagination' => [
                'total'         => $addresses->total(),
                'current_page'  => $addresses->currentPage(),
                'per_page'      => $addresses->perPage(),
                'last_page'     => $addresses->lastPage(),
                'from'          => $addresses->firstItem(),
                'to'            => $addresses->lastItem(),
            ],
         'addresses' => $addresses
        ];
    }

    public function search($query, $queryField)
    {
        $addresses = Address::join('clients','clients.id','addresses.client_id')
                ->select('clients.name','clients.code','addresses.*')
                ->where($query,'like','%' . $queryField . '%')->latest()
                ->orderBy('addresses.id', 'DESC')
                ->withTrashed()
                ->paginate(8);

        return compact('addresses');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
               if(!$request->ajax()) return redirect('/');

               $client = Client::findOrFail($request->id);
               $client_id = $client->id;
               $address = Address::findOrfail($client_id);
       
            //    $request->validate([
            //        'name'  => 'required|string',
            //        'razon_social'  => 'required|string',
            //        'nickname'  => 'required|string',
            //        'email'  => 'required|string|email|unique:clients,email,'.$client->id, 
            //        'birth_date' => 'required|date_format:Y-m-d',
            //        'reference'     => 'nullable|max:100',
            //        'cp'  => 'required',
            //        'cuit'  => 'required',
            //        'tax'  => 'required|numeric|min:0',
            //    ]);
       
               try{
       
                   DB::beginTransaction();
       
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
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
