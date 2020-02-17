<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Crawler\FabelioController;
use App\Http\Controllers\Crawler\TokopediaController;
use App\Interfaces\ProductInterface;
use App\Interfaces\ProductPhotoInterface;
use App\Transformers\ProductTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $product;
    private $productPhoto;

    public function __construct(ProductInterface $product, ProductPhotoInterface $productPhoto)
    {
        $this->product = $product;
        $this->productPhoto = $productPhoto;
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
            DB::beginTransaction();

            $crawler = new CrawlerController;
            $crawling = $crawler->initiate($request->link);

            //GET DATA
            $content = $crawling->getContent($request->link);
            $name = $crawling->getName($content);
            $description = $crawling->getDescription($content);
            $photos = $crawling->getPhoto($content);

            if(empty($name)) {
                DB::rollback();
                return response([
                    "error" => true
                    , "message" => 'Invalid product url'
                ],'400');
            }

            //SET PARAMETER CREATE
            $request->name = $name;
            $request->description = $description;
            $product = $this->product->create($request);

            //CREATE PHOTO OF PRODUCT
            foreach ($photos as $photo) {
                $photo_params = new \stdClass();
                $photo_params->product_id = $product->id;
                $photo_params->photo_url = $photo;
                $this->productPhoto->create($photo_params);
            }

            DB::commit();

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
            $product = $this->product->getPagination($request->limit);
            $transform = (new ProductTransformer())->transformPagination($product);
            return response($transform,'200');

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
            if($product) {
                return response([
                    "error" => false
                    , "data" => $product
                ],'200');
            }
            else{
                return response([
                    "error" => false
                    , "data" => new \stdClass()
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
