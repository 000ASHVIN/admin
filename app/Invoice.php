<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Orders;

class Invoice extends Model
{
    public function orders() {
        return $this->hasOne(Orders::class);
    }

    public function products() {
        return $this->hasOne(Products::class);
    }
}
