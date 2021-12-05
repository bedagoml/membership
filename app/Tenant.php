<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Tenant extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    protected $keyType = 'string';

    protected $guard = 'tenant';

    protected $hidden = ['password'];

    protected $guarded = [];
    
    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
     public function setCommitteesAttribute($value)
    {
        $this->attributes['committees'] = json_encode($value);
    }

    public function getCommitteesAttribute($value)
    {
        return $this->attributes['committees'] = json_decode($value);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function deposits()
    {
        return $this->hasMany('App\Deposit');
    }
    public function happy_hundreds()
    {
        return $this->hasMany('App\HappyHundred');
    }
    public function houseTenants()
    {
        return $this->hasMany('App\HouseTenant');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
    public function meeting_invoices()
    {
        return $this->hasMany('App\Meeting_invoice');
    }
    public function manual_payments()
    {
        return $this->hasMany('App\ManualPayment');
    }

    public function overpament()
    {
        return $this->hasOne('App\Overpayment');
    }
    public function subscription()
    {
        return $this->hasOne('App\Subscription');
    }
    public function overpaids()
    {
        return $this->hasMany('App\Overpaid');
    }

}
