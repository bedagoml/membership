<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HappyHundred extends Model
{
    protected $guarded = [];
    public function tenant()
    {
        return $this->belongsTo('App\Tenant');
    }
    public function contributions()
    {
        return $this->belongsTo('App\Contibution');
    }
}
