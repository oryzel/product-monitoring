<?php
/**
 * Created by PhpStorm.
 * User: Sabriyan
 * Date: 2/17/2020
 * Time: 10:32 PM
 */

namespace App\Transformers;

use Illuminate\Support\Carbon;

class ProductPriceHistoryTransformer
{

    public function transformChart($data)
    {
        $result = [];
        foreach ($data as $value) {

            array_push($result, [
                (Carbon::parse($value->created_at)->timestamp),
                (double) $value->price,
            ]);
        }
        return $result;
    }

}