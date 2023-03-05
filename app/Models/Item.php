<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model{
    
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function getRouteKeyName(){
       return 'slug';
    }

    public function auction(){
        return $this->hasOne(Auction::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
