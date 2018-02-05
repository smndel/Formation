<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class FrontController extends Controller
{
    public function index(){

    	$posts = Post::orderBy('started_at')->paginate(2);

    	return view('front.index', ['posts' => $posts]);
    }
}
