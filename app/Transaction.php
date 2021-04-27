<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailTransactions()
    {
        return $this->hasMany(DetailsTransaction::class);
    }
}
