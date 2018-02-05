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


    public function show(int $id){

    	$post = Post::find($id);
    	return view('front.show', ['post' => $post]);
    }




  public function showBookByCategory(int $id){
     	$category = Category::find($id);
    	$posts = $category->posts()->paginate(5);//on récupère tout les livres d'un auteur
    	//Que nous passons à la vue
    	return view('front.category', ['posts' => $posts, 'category' => $category]);
    }
}
