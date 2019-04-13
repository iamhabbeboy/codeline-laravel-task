<?php

use Illuminate\Database\Seeder;

class FilmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('films')->insert([[
            'name' => 'Mortal Kombat',
            'slug' => str_slug('mortal-kombat'),
            'description' => 'Lorem Ipsum has been the industry',
            'release_date' => '2019-04-24',
            'photo' => '/photos/1555160531-1555160531.jpg',
            'rating' => 5,
            'ticket_price' => 200,
            'country' => 'United States of America',
            'genre' => 'Action,Romantic',
        ],[
            'name' => 'Dragon 2',
            'slug' => str_slug('dragon-2'),
            'description' => 'Lorem Ipsum has been the industry',
            'release_date' => '2019-04-24',
            'photo' => '/photos/1555156714-1555156714.jpg',
            'rating' => 2,
            'ticket_price' => 100,
            'country' => 'Nigeria',
            'genre' => 'Action,Romantic,Drama',
        ], [
            'name' => 'Mortal Engine',
            'slug' => str_slug('mortal-engine'),
            'description' => 'Lorem Ipsum has been the industry',
            'release_date' => '2019-04-14',
            'photo' => '/photos/1555160441-1555160441.jpg',
            'rating' => 1,
            'ticket_price' => 250,
            'country' => 'Germany',
            'genre' => 'Action,Romantic',
        ]]);
    }
}
