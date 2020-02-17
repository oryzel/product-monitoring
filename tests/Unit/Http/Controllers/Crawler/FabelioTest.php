<?php

namespace Tests\Unit\Http\Controllers\Crawler;

use App\Http\Controllers\Crawler\FabelioController;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FabelioTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testGetContent()
    {
        $crawler = new FabelioController();
        $response = $crawler->getContent("https://fabelio.com/ip/leroy-high-sideboards-kit.html");
        $this->assertSame(gettype($response), 'string');
    }

    public function testGetNameSuccess()
    {
        $content = file('tests/Assets/Crawler/FabelioContent.html');
        $crawler = new FabelioController();
        $response = $crawler->getName(implode('', $content));
        $this->assertSame($response, 'Kabinet Leroy Pintu Kaca');
    }

    public function testGetNameFailed()
    {
        $crawler = new FabelioController();
        $response = $crawler->getName('false content');
        $this->assertSame($response, false);
    }

    public function testGetDescriptionSuccess()
    {
        $content = file('tests/Assets/Crawler/FabelioContent.html');
        $crawler = new FabelioController();
        $response = $crawler->getDescription(implode('', $content));
        $this->assertSame($response, 'Sentuhan Gaya Mid Century Pada Kabinet Display');
    }

    public function testGetDescriptionFailed()
    {
        $crawler = new FabelioController();
        $response = $crawler->getDescription('false content');
        $this->assertSame($response, false);
    }

    public function testGetPhotoSuccess()
    {
        $content = file('tests/Assets/Crawler/FabelioContent.html');
        $crawler = new FabelioController();
        $response = $crawler->getPhoto(implode('', $content));
        $this->assertSame($response[0], 'https://m2fabelio.imgix.net/catalog/product/cache/small_image/300x300/beff4985b56e3afdbeabfc89641a4582/k/u/Kubos_2020_Frame_0.jpg');

    }

    public function testGetPhotoFailed()
    {
        $crawler = new FabelioController();
        $response = $crawler->getPhoto('false content');
        $this->assertSame($response, []);
    }

    public function testGetCurrentPriceSuccess()
    {
        $content = file('tests/Assets/Crawler/FabelioContent.html');
        $crawler = new FabelioController();
        $response = $crawler->getCurrentPrice(implode('', $content));
        $this->assertSame(gettype($response), 'double');
    }

    public function testGetCurrentPriceFailed()
    {
        $crawler = new FabelioController();
        $response = $crawler->getDescription('false content');
        $this->assertSame($response, false);
    }

}
