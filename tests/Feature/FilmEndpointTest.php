<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilmEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShouldReturnAllFilms()
    {
        $response = $this->get('/api/films');
        // dd($response);
        $response->assertStatus(200);
    }

    public function testShouldReturnSingleFilm()
    {
        $response = $this->get('/api/films/dragon-2');
        $response->assertStatus(200);
    }

    public function testShouldCreateFilm()
    {
        $response = $this->get('/api/films/create', [
            'name' => 'Mortal Kombat',
            'slug' => str_slug('mortal-kombat'),
            'description' => 'Lorem Ipsum has been the industry',
            'release_date' => '2019-04-24',
            'photo' => '/photos/1555160531-1555160531.jpg',
            'rating' => 5,
            'ticket_price' => 200,
            'country' => 'United States of America',
            'genre' => 'Action,Romantic',
        ]);

        $response->assertStatus(200);
    }

    public function testShouldAddGenre()
    {
        $response = $this->post('/api/genre', [
            'title' => 'Action'
        ]);
        $response->assertStatus(200);
    }
}
