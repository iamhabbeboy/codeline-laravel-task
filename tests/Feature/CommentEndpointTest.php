<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentEndpointTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldDisplayCommentInSingleFilm()
    {
        $response = $this->get('/api/films/comment/dragon-2');
        $response->assertStatus(200);
    }

    public function testShouldPostCommentInSingleFilm()
    {
        $response = $this->post('/api/films/comment', [
            'name' => 'user',
            'film_slug' => 'dragon-2',
            'comment' => 'comment dummy test'
        ]);
        $response->assertStatus(200);
    }
}
