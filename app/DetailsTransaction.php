<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailsTransaction extends Model
{
    protected $fillable = [
        'transaction_id',
        'book_id',
        'quantity',
        'price',
        'weight'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
