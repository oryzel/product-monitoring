<?php
/**
 * Created by PhpStorm.
 * User: Sabriyan
 * Date: 2/15/2020
 * Time: 11:10 AM
 */

namespace App\Repositories;


use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{

    public function create($params){

        $model = new Product();
        $model->name = (string) $params->name;
        $model->description = (string) $params->description;
        $model->link = (string) $params->link;

        $model->save();

        return $model;
    }

    public function updateName($model, $name){

        $model->name = (string)$name;

        $model->save();

        return $model;
    }

    public function updateDescription($model, $description){

        $model->description = (string)$description;

        $model->save();

        return $model;
    }

    public function getList($limit) {
        return Product::where('is_deleted', false)
            ->paginate($limit ?? 5);
    }

    public function getById($id) {
        return Product::where('id', (int) $id)
            ->where('is_deleted', false)
            ->first();
    }

}