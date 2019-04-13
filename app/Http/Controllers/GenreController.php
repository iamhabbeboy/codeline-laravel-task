<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * @var Genre
     */
    protected $genre;
    /**
     * @param Genre $genre
     */
    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required|string']);
        $response = $this->genre->firstOrCreate(['title' => $request->title], $request->all());
        $json['status'] = 'success';
        $json['result'] = $response;
        return response()->json($json);
    }
}
