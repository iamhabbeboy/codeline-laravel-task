<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmFrontendController extends Controller
{
    /**
     * @var Comment
     */
    protected $comment;
    /**
     * @var Genre
     */
    protected $genre;
    /**
     * @param Genre $genre
     */
    public function __construct(Genre $genre, Comment $comment)
    {
        $this->genre = $genre;
        $this->comment = $comment;
    }

    public function index()
    {
        return view('index');
    }

    public function single()
    {
        return view('single');
    }

    public function create()
    {
        $genres = $this->genre->all();
        return view('create', compact('genres'));
    }
}
