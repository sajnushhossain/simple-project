<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_the_search_page_returns_a_200_status_code()
    {
        $response = $this->get('/search');

        $response->assertStatus(200);
    }
}
