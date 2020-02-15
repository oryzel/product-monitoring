<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';


    /**
     * Get the photos for product.
     */
    public function photo()
    {
        return $this->hasMany('App\Models\ProductPhoto', 'product_id', 'id')->where('is_deleted', false);
    }

    /**
     * Get the price history for product.
     */
    public function priceHistory()
    {
        return $this->hasMany('App\Models\ProductPriceHistory', 'product_id', 'id')->where('is_deleted', false);
    }
}
