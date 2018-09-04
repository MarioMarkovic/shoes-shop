<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order_items;

class Order extends Model
{
    protected $fillable = [ 'token', 'first_name', 'last_name', 'email', 'city', 'post_number', 'street_name', 'street_number', 'phone', 'total_quantity', 'total_price', 'status' ];

    public function order_items()
    {
    	return $this->hasMany(Order_items::class);
    }
}
