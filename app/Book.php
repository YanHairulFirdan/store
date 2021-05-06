<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    public function detailTransaction()
    {
        return $this->belongsToMany(DetailsTransaction::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
