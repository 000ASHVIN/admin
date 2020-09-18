<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CartItem;

class Carts extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cartitem() {
        return $this->hasMany(CartItem::class);
    }
}
