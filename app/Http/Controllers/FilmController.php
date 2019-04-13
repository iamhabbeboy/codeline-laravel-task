<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{

    protected $comment;
    /**
     * @var Film
     */
    protected $film;
    /**
     * @param Film $film
     */
    public function __construct(Film $film, Comment $comment)
    {
        $this->film = $film;
        $this->comment = $comment;
    }

    public function show()
    {
        $response = $this->film->orderBy('id', 'desc')->get();
        $responseJson['status'] = 'success';
        $responseJson['result'] = $response;
        return response()->json($responseJson);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'genre' => 'required',
            'name' => 'required|string',
            'country' => 'required|string',
            'description' => 'required|string',
            'release_date' => 'required|string',
            'ticket_price' => 'required|integer',
            'rating' => 'required|integer|between:1,5',
        ]);

        $data = $request->all();
        $data['photo'] = $this->processPhoto($request->file('photo'));
        $data['slug'] = str_slug($request->name, '-');
        $response = $this->film->firstOrCreate(['name' => $request->name], $data);
        $json['status'] = 'success';
        $json['result'] = $response;
        return response()->json($json);
    }

    protected function processPhoto($photo)
    {
        if ($photo ) {
            $image = $photo;
            $destinationPath = 'photos';
            $filename = time(). '-'. time().'.jpg';
            return ($image->move($destinationPath,$filename)) ? '/photos/'.$filename
            : null;
        }
    }

    public function single(string $slug)
    {
        $response = $this->film->where('slug', $slug)->get()->first();
        $json['status'] = 'success';
        $json['result'] = $response;
        return response()->json($json);
    }


}
