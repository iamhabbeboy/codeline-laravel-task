<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * @var Comment
     */
    protected $comment;
    /**
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function show(string $slug)
    {
        $response = $this->comment->where('film_slug', $slug)->orderBy('id', 'desc')->get();
        $json['status'] = 'success';
        $json['result'] = $response;
        return response()->json($json);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'comment' => 'required|string',
            'film_slug' => 'required|string',
        ]);

        $data = $request->all();
        $response = $this->comment->create($data);
        $json['status'] = 'success';
        $json['result'] = $response;
        return response()->json($json);
    }
}
