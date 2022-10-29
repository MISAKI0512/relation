<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('index', ['authors' => $authors]);
    }
		// 追記：ここから
    public function find()
    {
        return view('find', ['input' => '']);
    }
    public function search(Request $request)
    {
        $author = Author::find($request->input);
        $param = [
            'author' => $author,
            'input' => $request->input
        ];
        return view('find', $param);
    }
		// 追記：ここまで


// middleware
public function get()
{
    $text = [
        'content' => '自由に入力してください',
    ];
    return view('middleware', $text);
}
public function post(Request $request)
{
    $content = $request->content;
    $text = [
        'content' => $content . 'と入力しましたね'
    ];
    return view('middleware', $text);
}

public function relate(Request $request)
    {
        $authors = Author::all();
        return view('author.index', ['authors' => $authors]);
    }

}