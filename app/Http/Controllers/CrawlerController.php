<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductInterface;
use App\Interfaces\ProductPhotoInterface;
use App\Interfaces\ProductPriceHistoryInterface;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerController extends Controller
{
    private $product;
    private $productPhoto;
    private $productHistory;

    public function __construct(ProductInterface $product, ProductPriceHistoryInterface $productHistory, ProductPhotoInterface $productPhoto)
    {
        $this->product = $product;
        $this->productPhoto = $productPhoto;
        $this->productHistory = $productHistory;
    }

    public function getCurrentPrice(Request $request)
    {

        try{
            $products = $this->product->getList();

            $result = array();

            foreach ($products as $product) {

                $client = new \GuzzleHttp\Client();

                $request = $client->get($product->link);

                $response = $request->getBody()->getContents();
                $crawler = new Crawler($response);

                $filter = $crawler->filter('#maincontent > div > div > div > div > div > div > span > span > span > span');

                if(count($filter) > 0)
                {
                    foreach ($filter as $i => $content)
                    {
                        $price = explode("Rp ", $content->nodeValue);
                        $price = str_replace('.','', $price);
                        $params = new \stdClass();
                        $params->product_id = $product->id;
                        $params->price = $price[1];
                        $product_history = $this->productHistory->create($params);

                        array_push($result, $product_history);
                        break;

                    }

                }

            }

            return response([
                "error" => false
                , "data" => $result
            ],'200');

        }
        catch (\Exception $ex) {
            return response([
                "error" => true
                ,"message" => $ex->getMessage()
            ],'500');

        }
    }

    public function getName($product_id)
    {

        try{
            $product = $this->product->getById($product_id);
            if(!$product) {
                return response([
                    "error" => true
                    ,"message" => "data not found"
                ],'404');
            }

            $client = new \GuzzleHttp\Client();

            $request = $client->get($product->link);

            $response = $request->getBody()->getContents();
            $crawler = new Crawler($response);

            $filter = $crawler->filter('#maincontent > div > div > div > div > h1 > span');

            if(count($filter) > 0)
            {
                foreach ($filter as $i => $content)
                {

                    $result = $this->product->updateName($product, $content->nodeValue);

                    return response([
                        "error" => false
                        , "data" => $result
                    ],'200');

                }

            }


        }
        catch (\Exception $ex) {
            return response([
                "error" => true
                ,"message" => $ex->getMessage()
            ],'500');
        }
    }

    public function getDescription($product_id)
    {

        try{
            $product = $this->product->getById($product_id);
            if(!$product) {
                return response([
                    "error" => true
                    ,"message" => "data not found"
                ],'404');
            }

            $client = new \GuzzleHttp\Client();

            $request = $client->get($product->link);

            $response = $request->getBody()->getContents();
            $crawler = new Crawler($response);

            $filter = $crawler->filter('#description > p');


            if(count($filter) > 0)
            {
                foreach ($filter as $i => $content)
                {
                    $result = $this->product->updateDescription($product, $content->nodeValue);

                    return response([
                        "error" => false
                        , "data" => $result
                    ],'200');

                }

            }


        }
        catch (\Exception $ex) {
            return response([
                "error" => true
                ,"message" => $ex->getMessage()
            ],'500');

        }
    }

    public function getPhoto($product_id)
    {


        $result = array();
        try{
            $product = $this->product->getById($product_id);
            if(!$product) {
                return response([
                    "error" => true
                    ,"message" => "data not found"
                ],'404');
            }

            $client = new \GuzzleHttp\Client();

            $request = $client->get($product->link);

            $response = $request->getBody()->getContents();
            $crawler = new Crawler($response);
            $filter = $crawler
                ->filterXpath('//img')
                ->extract(array('src'));


            $searchword = "m2fabelio.imgix.net";
            $image = array_filter($filter, function($var) use ($searchword) { return preg_match("/\b$searchword\b/i", $var); });

            if(count($filter) > 0)
            {
                foreach ($image as $image)
                {
                    $params = new \stdClass();
                    $params->product_id = $product->id;
                    $params->photo_url = $image;
                    $productPhoto = $this->productPhoto->create($params);
                    array_push($result, $productPhoto);

                }

            }

            return response([
                "error" => false
                , "data" => $result
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
