<?php
/**
 * Created by PhpStorm.
 * User: Sabriyan
 * Date: 2/17/2020
 * Time: 10:32 PM
 */

namespace App\Transformers;


class ProductTransformer
{

    public function transformPagination($data)
    {
        $result = $data->toarray();
        $result['error'] = false;
        $result['draw'] = $result['total'];
        $result['recordsTotal'] = $result['total'];
        $result['recordsFiltered'] = $result['total'];

        return $result;
    }

}