<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting_invoice extends Model
{
    protected $guarded = [];


    public function tenant()
    {
        return $this->belongsTo('App\Tenant');
    }
    public function meeting()
    {
        return $this->belongsTo('App\Meeting');
    }
}
