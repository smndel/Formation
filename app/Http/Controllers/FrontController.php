<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Input;

class FrontController extends Controller
{
    public function __construct(){
        view()->composer('partials.menu', function($view){
            $types = Post::pluck('post_type', 'id')->unique();
            $view->with('types', $types);
        });
    }

    public function index(){

        $posts = Post::whereRaw('started_at >= now()')->published()->orderBy('started_at')->take(2)->get();
        return view('front.index', ['posts' => $posts]);
    }

    public function show(int $id){

        $post = Post::find($id)->published();
        return view('front.show', ['post' => $post]);
    }

    public function showPostByType(string $type){

<<<<<<< HEAD
        $posts = Post::select()->where('post_type', $type)->published()->paginate(5);
=======
        $posts = Post::select()->where('post_type', $type)->paginate(5);
>>>>>>> Dev
        $type = $type;
        return view('front.type', ['posts' => $posts, 'type' =>$type]);
    }

    public function search(Request $request)
    {
       $q = $request->q; 

<<<<<<< HEAD
       $posts = Post::published()
                ->search($q)
                ->paginate(5);
=======
        $this->validate($request, [
        'q' => "required",
        ]);

        $q = $request->q;

        $posts = Post::where ( 'title', 'LIKE', '%' . $q . '%' )
                        ->orWhere('post_type', 'LIKE', '%' . $q . '%' )
                        ->orWhere('description', 'LIKE', '%' . $q . '%' )->paginate(5); 
                        // ->paginate(5);
>>>>>>> Dev

        if (count ( $posts ) > 0)
            return view ('front.search' )->withDetails($posts)->withQuery( $q );
        else
            return view ('front.search' )->withMessage('No Details found. Try to search again !' );
    }
}
