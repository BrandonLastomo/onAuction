<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionHistory extends Model
{
    use HasFactory;

    public $guarded = [
        'id'
    ];

    public function auction(){
        return $this->belongsTo(Auction::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
