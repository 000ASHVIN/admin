<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Carts;
use \App\Products;

class CartItem extends Model
{
    public function carts() {
        return $this->belongsTo(Carts::class);
    }

    public function products() {
        return $this->belongsTo(Products::class);
    }
}
