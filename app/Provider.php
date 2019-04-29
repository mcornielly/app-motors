<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'id', 'contac_name', 'cellphone', 'phone_number'
    ];

    public $timestamps = false;

    public function clinet()
    {
        return $this->belongsTo('App\Client');
    }
}
