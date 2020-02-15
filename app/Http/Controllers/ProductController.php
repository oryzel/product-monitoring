<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'link' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                "error" => true
                ,"message" => implode($validator->errors()->all(), " | ")
            ],'400');
        }

        try{
            $product = $this->product->create($request);
            return response([
                "error" => false
                , "data" => $product
            ],'200');

        }
        catch (\Exception $ex) {
            return response([
                "error" => true
                ,"message" => $ex->getMessage()
            ],'500');

        }
    }

    public function getList(Request $request) {

        try{
            $product = $this->product->getList();
            return response([
                "error" => false
                , $product
            ],'200');

        }
        catch (\Exception $ex) {
            return response([
                "error" => true
                ,"message" => $ex->getMessage()
            ],'500');

        }
    }

    public function get($id) {

        try{
            $product = $this->product->getById($id);
            return response([
                "error" => false
                , "data" => $product
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
