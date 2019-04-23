<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['client_id', 'address', 'locality', 'province', 'phone_number', 'nextel_number', 'cell_number'];

    public function client ()
    {
    	return $this->belongsTo('App\Client');
    }
}
