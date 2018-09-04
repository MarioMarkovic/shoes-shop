<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Quantity_size;
use App\Category;

class Product extends Model
{
    protected $fillable = [ 'name', 'image', 'description', 'price', 'discount', 'catalog_number', 'category_id' ];

    public function quantity_size()
    {
    	return $this->hasMany(Quantity_size::class);
    }

    public function category() {
    	return $this->belongsTo(Category::class);
    }
}
