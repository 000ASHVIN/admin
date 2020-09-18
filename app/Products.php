<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Category;
use \App\CartItem;
use \App\Suborders;

class Products extends Model
{
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function cartitem() {
        return $this->hasMany(CartItem::class);
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function suborders() {
        return $this->hasMany(Suborders::class);
    }
}
