<?php

namespace App\Http\Controllers\Crawler;

use App\Interfaces\CrawlerInterface;
use Symfony\Component\DomCrawler\Crawler;

class FabelioController implements CrawlerInterface
{

    public function getContent($link)
    {

        $client = new \GuzzleHttp\Client();
        $request = $client->get($link);
        $response = $request->getBody()->getContents();

        return $response;

   }

    public function getCurrentPrice($content)
    {

        $crawler = new Crawler($content);

        $filter = $crawler->filter('#maincontent > div > div > div > div > div > div > span > span > span > span');

        if(count($filter) > 0)
        {
            foreach ($filter as $i => $content)
            {
                $price = explode("Rp ", $content->nodeValue);
                $price = str_replace('.','', $price[1]);
                return (double) $price;
            }

        }
        return false;

    }

    public function getName($content)
    {

        $crawler = new Crawler($content);
        $filter = $crawler->filter('#maincontent > div > div > div > div > h1 > span');

        if(count($filter) > 0)
        {
            foreach ($filter as $i => $content)
            {
                return $content->nodeValue;
            }
        }

        return false;

    }

    public function getDescription($content)
    {

        $crawler = new Crawler($content);
        $filter = $crawler->filter('#description > p');
        if(count($filter) > 0)
        {
            foreach ($filter as $i => $content)
            {
                return $content->nodeValue;
            }

        }

        return false;
    }

    public function getPhoto($content)
    {

        $result = [];

        $crawler = new Crawler($content);
        $filter = $crawler
            ->filterXpath('//img')
            ->extract(array('src'));

        $searchword = "m2fabelio.imgix.net";
        $images = array_filter($filter, function ($var) use ($searchword) {
            return preg_match("/\b$searchword\b/i", $var);
        });

        if (count($images) > 0) {
            foreach ($images as $image) {
                array_push($result, $image);

            }

        }

        return $result;

    }
    
}
