<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use RefreshDatabase;

    protected static $setUpHasRunOnce = false;

    public function setUp()
    {
        parent::setUp();
        if (!static::$setUpHasRunOnce) {
            Artisan::call('migrate:fresh');
            Artisan::call(
                'db:seed', ['--class' => 'DatabaseSeeder']
            );
            static::$setUpHasRunOnce = true;
        }
    }

    public function testCreateSuccess()
    {

        $data = [	"link" => "https://fabelio.com/ip/leroy-high-sideboards-kit.html"];

        $response = $this->post('/', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' =>[
                'name',
                'description',
                'link',
                'id'
            ]
        ]);

    }

    public function testCreateFail()
    {

        $data = [	"link" => "https://google.com"];
        $response = $this->post('/', $data);
        $response->assertStatus(400);

    }

    public function getListSuccess()
    {

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'data' => [
                    '*' =>[
                        'name',
                        'description',
                        'link',
                        'id'
                    ]
                ]
            ]
        ]);

    }

    public function testGetSuccess()
    {
        $response = $this->get('/1');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'name',
                'description',
                'link',
                'id'
            ]
        ]);

    }

    public function testGetFail()
    {

        $response = $this->get('/0');
        $response->assertStatus(404);

    }

}
