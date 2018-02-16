<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\post;
use App\Category;
use App\Teacher;
use Carbon\Carbon;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        view()->composer('partials.menu', function($view){
            $types = Post::pluck('post_type', 'id')->unique();
            $view->with('types', $types);
        });
    }


    public function index()
    {
        $posts = Post::paginate(10);

        return view('back.post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::pluck('name', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();
        $types = Post::pluck('post_type', 'id')->unique();

        return view('back.post.create', ['teachers'=>$teachers, 'categories'=>$categories, 'types'=>$types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //hydratation des données du Post enregistré en base de données
        $post = post::create($request->all());
        $post->teachers()->attach($request->teachers);

        $img = $request->file('picture');
            
        if(!empty($img)){

            $link = $request->file('picture')->store('./');
     
            $post->picture()->create([
            'link' => $link,
            ]);
        }
      
        return redirect()->route('post.index')->with('message', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('back.post.show' ,['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $teachers = Teacher::pluck('name', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();
        
        return view('back.post.edit', ['teachers'=>$teachers, 'categories'=>$categories, 'post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id); 
        $post->update($request->all()); 
        $post->teachers()->sync($request->teachers); 
    
        $image = $request->file('picture');    

        if(!empty($image)){
            
            if(count($post->picture)>0){
                Storage::disk('local')->delete($post->picture->link);
                $post->picture()->delete();
            }

        $link = $request->file('picture')->store('./');
        $post->picture()->create(['link' => $link]);
        }
       
        return redirect()->route('post.index')->with('message', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('post.index')->with('message', 'success');
    }

    //Fonction pour la supression multiple sur le Dashboard
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Post::whereIn('id',explode(",",$ids))->delete();

        return response()->json(['success'=>"Posts Deleted successfully."]);
    }

    //Fonction pour la barre de recherche sur le Dashboard
    public function search(Request $request)
    {
       $q = $request->q; 

       $posts = Post::search($q)
                ->paginate(10);

        if (count ( $posts ) > 0)
            
        return view ('back.post.search' )->withDetails($posts)->withQuery( $q );
        
        else

        return view ('back.post.search' );
    }


    //Tri du tableau sur le dashboard
    public function sortDashboard(Request $request){

        $title = $request->title;

        $posts = Post::sortBack($title);

        return view('back.post.index', ['posts' => $posts]);
    
    }

    //Changement du status avec AJAX
    public function changeStatus(Request $request) 
    {
        $id = $request->id?? null;

        $post = Post::find($id);

        if ($post->status == 'published'){

            $post->status = 'unpublished';

        }else{
            
            $post->status = 'published';
        }

        $post->save();

        $data = ['id' => $post->id, 'status' => $post->status];

        return response()->json($data);
    }

}
