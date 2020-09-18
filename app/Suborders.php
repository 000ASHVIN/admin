<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Orders;
use \App\Products;

class Suborders extends Model
{
    public function orders() {
        return $this->belongsTo(Orders::class);
    }

    public function products() {
        return $this->belongsTo(Products::class);
    }
}
