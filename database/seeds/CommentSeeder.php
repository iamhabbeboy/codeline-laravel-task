<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'name' => 'user',
                'film_slug' => 'dragon-2',
                'comment' => 'Nice movie'
            ],
            [
                'name' => 'user',
                'comment' => 'Nice movie',
                'film_slug' => 'mortal-kombat',
            ],
            [
                'name' => 'user',
                'comment' => 'Nice movie',
                'film_slug' => 'mortal-engine',
            ]
        ]);
    }
}
