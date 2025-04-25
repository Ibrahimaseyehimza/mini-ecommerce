<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    
    public function orders(){
        return $this->belongsTo(Order::class);
    }

    public function products()
    {
        return $this->belongsTo(Category::class);
    }
}
