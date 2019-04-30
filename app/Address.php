<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    use SoftDeletes;

    protected $fillable = ['client_id', 'address', 'locality', 'province', 'phone_number', 'nextel_number', 'cell_number'];

    protected $dates = ['deleted_at'];

    public function client ()
    {
    	return $this->belongsTo('App\Client');
    }
}
