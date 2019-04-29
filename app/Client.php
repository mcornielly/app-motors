<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Client extends Model
{
    
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    use SoftDeletes;

    protected $fillable = [
        'code', 'name', 'razon_social', 'nickname', 'email', 'birth_date', 'reference', 'cp', 'cuit', 'tax'
    ];
    
    protected $dates = ['deleted_at'];

    protected $softCascade = ['addresses'];

    public function addresses ()
    {
    	return $this->hasMany('App\Address');
    }

    public function provider()
    {
        return $this->hasOne('App\Provider');   
    }
}
