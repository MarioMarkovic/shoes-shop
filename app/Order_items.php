<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
    protected $table = 'order_items';

    protected $fillable = [ 'order_id', 'item_size', 'item_name', 'item_price', 'item_catalog_number', 'item_total_quantity', 'item_total_price' ];
}
