<?php
/**
 * Created by PhpStorm.
 * User: Sabriyan
 * Date: 2/15/2020
 * Time: 11:10 AM
 */

namespace App\Repositories;

use App\Interfaces\ProductPhotoInterface;
use App\Models\ProductPhoto;

class ProductPhotoRepository implements ProductPhotoInterface
{

    public function create($params){

        $model = new ProductPhoto();
        $model->product_id = (int) $params->product_id;
        $model->photo_url = (string) $params->photo_url;

        $model->save();

        return $model;
    }

    public function getList($product_id) {
        return ProductPhoto::where('product_id', (int) $product_id)
            ->where('is_deleted', false)
            ->get();
    }


}