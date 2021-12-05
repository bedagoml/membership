<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner_invoices extends Model
{
    // use SoftDeletes;
    
    protected $guarded = [];
    public function landlord()
    {
        return $this->belongsTo('App\Landlord');
    }

    public function house()
    {
        return $this->belongsTo('App\House');
    }

    public function apartment()
    {
        return $this->belongsTo('App\Apartment');
    }
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
   
}
