<?php
/**
 * Created by PhpStorm.
 * User: Sabriyan
 * Date: 2/16/2020
 * Time: 6:37 PM
 */

namespace App\Interfaces;


interface CrawlerInterface
{

    public function getContent($link);
    public function getCurrentPrice($link);
    public function getName($content);
    public function getDescription($content);
    public function getPhoto($content);

}