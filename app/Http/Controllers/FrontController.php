<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Input;
use Cache;

class FrontController extends Controller
{
    //Menu
    public function __construct(){
        view()->composer('partials.menu', function($view){
            $types = Post::pluck('post_type', 'id')->unique();
            $view->with('types', $types);
        });
    }

    //Page Index 
    public function index(){

        $prefix = request()->page?? 'index';

        $path = 'post' . $prefix;

        $posts = Cache::remember($path, 60*24, function(){
            
        return Post::whereRaw('started_at >= now()')
                    ->with('category', 'teachers', 'picture')
                    ->published()
                    ->orderBy('started_at')
                    ->take(2)
                    ->get();
        });

        return view('front.index', ['posts' => $posts]);
    }

    //Page Show
    public function show(int $id){
        
        $post = Post::find($id);

        return view('front.show', ['post' => $post]);
    }

    //Affichage des pages en fonction de leur type : stage ou formation
    public function showPostByType(string $type){

        $posts = Post::select()->where('post_type', $type)->published()->paginate(5);

        return view('front.type', ['posts' => $posts, 'type' =>$type]);
    }

    //Recherche sur la page index
    public function search(Request $request){
      
       $q = $request->q; 

       $posts = Post::published()
                ->search($q)
                ->paginate(5);

        if (count ( $posts ) > 0)

        return view ('front.search' )->withDetails($posts)->withQuery( $q );
        
        else
            
        return view ('front.search' );
    }
}
