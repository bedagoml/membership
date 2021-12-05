<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $guarded = [];


    public function manual_payments()
    {
        return $this->hasMany('App\ManualPayment');
    }
}
