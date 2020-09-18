<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\User;
class Orders extends Model
{
    protected $guarded = [];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function suborders() {
        return $this->hasMany(Suborders::class);
    }
}
