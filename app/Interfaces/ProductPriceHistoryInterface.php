<?php
/**
 * Created by PhpStorm.
 * User: Sabriyan
 * Date: 2/15/2020
 * Time: 11:09 AM
 */

namespace App\Interfaces;


interface ProductPriceHistoryInterface
{

    public function create($params);
    public function getList($product_id);

}