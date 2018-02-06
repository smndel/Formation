<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class FrontController extends Controller
{
    public function __construct(){
        view()->composer('partials.menu', function($view){
            $types = Post::pluck('post_type', 'id')->unique();
            $view->with('types', $types);
        });
    }

    public function index(){

        $posts = Post::orderBy('started_at')->paginate(2);
        return view('front.index', ['posts' => $posts]);
    }

    public function show(int $id){

        $post = Post::find($id);
        return view('front.show', ['post' => $post]);
    }

    public function showPostByType(string $type){
        $posts = Post::select()->where('post_type', $type)->paginate(5);
        $type = $type;
        return view('front.type', ['posts' => $posts, 'type' =>$type]);
    }
}
