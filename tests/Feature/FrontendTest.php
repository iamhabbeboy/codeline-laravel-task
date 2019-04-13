<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FrontendTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShouldRedirect()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function testShouldSeeHomepage()
    {
        $response = $this->get('/films');
        $response->assertStatus(200);
    }

    public function testShouldVisitSingleFilmPage()
    {
        $response = $this->get('/films/dragon-2');
        $response->assertStatus(200);
    }
}
