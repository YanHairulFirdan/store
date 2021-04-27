<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailsTransaction extends Model
{
    public function book()
    {
        return $this->hasOne(Book::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
