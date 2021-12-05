<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $guarded = [];


    public function meeting_invoices()
    {
        return $this->hasMany('App\Meeting_invoice');
    }
}
