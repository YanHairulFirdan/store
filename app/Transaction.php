<?php

namespace App;

use Carbon\Carbon as CarbonCarbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Transaction extends Model
{
    protected $dates = [
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailTransactions()
    {
        return $this->hasMany(DetailsTransaction::class);
    }

    // public function getCreatedAtAttribute($value)
    // {
    //     return CarbonCarbon::createFromFormat('d-m-Y', $value)->format('d-m-Y');
    // }
}
