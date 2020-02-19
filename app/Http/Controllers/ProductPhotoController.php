<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductInterface;
use App\Interfaces\ProductPhotoInterface;
use App\Interfaces\ProductPriceHistoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductPhotoController extends Controller
{
    private $product_photo;

    public function __construct(ProductPhotoInterface $product_photo)
    {
        $this->product_photo = $product_photo;
    }


    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                "error" => true
                ,"message" => implode($validator->errors()->all(), " | ")
            ],'400');
        }

        $product_photo = [];
        try{
            foreach ($request->photos as $photo) {
                $photo_params = new \stdClass();
                $photo_params->product_id = $request->product_id;
                $photo_params->photo_url = $photo;
                array_push($product_photo, $this->product_photo->create($photo_params));
            }

            return response([
                "error" => false
                , "data" => $product_photo
            ],'200');
        }
        catch (\Exception $ex) {
            return response([
                "error" => true
                ,"message" => $ex->getMessage()
            ],'500');

        }
    }
    public function getList($product_id) {

        try{
            $product_photo = $this->product_photo->getList($product_id);
            if(sizeof($product_photo) > 0) {
                return response([
                    "error" => false
                    , "data" => $product_photo
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
