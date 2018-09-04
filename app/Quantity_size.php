<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quantity_size extends Model
{
    protected $table = 'quantity_size';

    protected $fillable = [ 'size', 'quantity', 'product_id' ];
}
