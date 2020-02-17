<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductInterface;
use App\Interfaces\ProductPriceHistoryInterface;
use App\Transformers\ProductPriceHistoryTransformer;

class ProductPriceHistoryController extends Controller
{
    private $product;
    private $product_price_history;

    public function __construct(ProductInterface $product, ProductPriceHistoryInterface $product_price_history)
    {
        $this->product = $product;
        $this->product_price_history = $product_price_history;
    }

    public function create() {

        $result = [];
        $products = $this->product->getList();
        foreach ($products as $product) {

            $crawler = new CrawlerController;
            $crawling = $crawler->initiate($product->link);

            //GET DATA
            $content = $crawling->getContent($product->link);
            $price = $crawling->getCurrentPrice($content);

            $params = new \stdClass();
            $params->product_id = $product->id;
            $params->price = $price;
            array_push($result, $this->product_price_history->create($params));
        }

        return response([
            "error" => false
            , "data" => $result
        ],'200');
    }

    public function getList($product_id) {

        try{
            $product_price_history = $this->product_price_history->getList($product_id);
            if(sizeof($product_price_history) > 0) {
                return response([
                    "error" => false
                    , "data" => $product_price_history
                ],'200');
            }
            else{
                return response([
                    "error" => false
                    , "data" =>[]
                ],'404');
            }

        }
        catch (\Exception $ex) {
            return response([
                "error" => true
                ,"message" => $ex->getMessage()
            ],'500');

        }
    }

    public function getChart($product_id) {

        try{
            $product_price_history = $this->product_price_history->getChart($product_id);

            $transform = (new ProductPriceHistoryTransformer())->transformChart($product_price_history);
            if(sizeof($product_price_history) > 0) {
                return response([
                    "error" => false
                    , "data" => $transform
                ],'200');
            }
            else{
                return response([
                    "error" => false
                    , "data" =>[]
                ],'404');
            }

        }
        catch (\Exception $ex) {
            return response([
                "error" => true
                ,"message" => $ex->getMessage()
            ],'500');

        }
    }

}
