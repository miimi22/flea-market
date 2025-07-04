<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Item extends Model
{
    use HasFactory;

    public function likes(){
        return $this->hasMany(Like::class);
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
        return $this->belongsTo('App\Models\Condition');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_category');
    }

    public function isSold()
    {
        if ($this->payment()->exists()) {
            return true;
        }

        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tradingComments()
    {
        return $this->hasMany(TradingComment::class);
    }
}
