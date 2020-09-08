<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Products;

class Category extends Model
{
    protected $guarded = [];

    public function products() {
        return $this->hasMany(Products::class);
    }
}
