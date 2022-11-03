<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//追記

class AuthorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $authors = Author::paginate(4);
        $param = ['authors' => $authors, 'user' =>$user];
        return view('index', $param);
    }

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
        $hasbooks = Author::has('book')->get();
        $nobooks = Author::doesntHave('book')->get();
        $param = ['hasbooks' => $hasbooks, 'nobooks' => $nobooks];
        return view('author.index',$param);
    }

public function check(Request $request)
    {
    $text = ['text' => 'ログインして下さい。'];
    return view('auth', $text);
    }

    public function checkUser(Request $request)
    {
    $email = $request->email;
    $password = $request->password;
    if (Auth::attempt(['email' => $email,
            'password' => $password])) {
        $text =   Auth::user()->name . 'さんがログインしました';
    } else {
        $text = 'ログインに失敗しました';
    }
    return view('auth', ['text' => $text]);
    }
}