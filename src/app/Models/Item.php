<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function payment(){
        return $this->hasOne('App\Models\Payment');
    }

    public function itemcategories(){
        return $this->hasMany('App\Models\ItemCategory');
    }

    public function condition(){
        return $this->hasOne('App\Models\Condition');
    }
}
