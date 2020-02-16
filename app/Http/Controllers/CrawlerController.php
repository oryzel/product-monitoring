<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Http\Controllers\Crawler\FabelioController;

class CrawlerController extends Controller
{

    private function checkVendor($link) {

        $link = explode(".com", $link);

        if (strpos($link[0], Constant::VENDOR_FABELIO) !== false) {
            return Constant::VENDOR_FABELIO;
        }

    }

    public function initiate($link) {

        $vendor = self::checkVendor($link);

        switch ($vendor) {
            case Constant::VENDOR_FABELIO:
                return New FabelioController();
            default:
                return New FabelioController();
        }


    }
}
