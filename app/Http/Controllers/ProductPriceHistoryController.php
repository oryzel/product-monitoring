<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductInterface;
use App\Interfaces\ProductPriceHistoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductPriceHistoryController extends Controller
{
    private $product_price_history;

    public function __construct(ProductPriceHistoryInterface $product_price_history)
    {
        $this->product_price_history = $product_price_history;
    }


    public function getList($product_id) {

        try{
            $product_price_history = $this->product_price_history->getList($product_id);
            return response([
                "error" => false
                , $product_price_history
            ],'200');

        }
        catch (\Exception $ex) {
            return response([
                "error" => true
                ,"message" => $ex->getMessage()
            ],'500');

        }
    }

}
