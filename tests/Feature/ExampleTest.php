<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->withHeaders([
            'authorization' => 'Bearer 1|x6Xz4Pn9bh3nlJDBxFFe4hUeVYuEqXI5FvwZ8E7w',
        ])->get('/api/dashboard');

        $response->assertStatus(200);
        $response->assertJson(Auth::user()->toArray());
    }
}
