<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    private function ddResponse($response)
    {
        if ($response->exception == null) {
            $contents = json_decode(($response->baseResponse->getContent()));
            if ($contents == null) {
                dd(null);
            }

            dd($contents->data);
        } else {
            dd($response->exception);
        }
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');
        $this->ddResponse($response);
        $response->assertStatus(200);
    }
}
