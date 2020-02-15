<?php
/**
 * Created by PhpStorm.
 * User: Sabriyan
 * Date: 2/15/2020
 * Time: 11:10 AM
 */

namespace App\Repositories;


use App\Interfaces\ProductPriceHistoryInterface;
use App\Models\ProductPriceHistory;

class ProductPriceHistoryRepository implements ProductPriceHistoryInterface
{

    public function create($params){

        $model = new ProductPriceHistory();
        $model->product_id = (int) $params->product_id;
        $model->price = (double) $params->price;

        $model->save();

        return $model;
    }

    public function getList($product_id) {
        return ProductPriceHistory::where('product_id', $product_id)
            ->where('is_deleted', false)
            ->paginate(30);
    }


}