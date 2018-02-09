<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function store(Request $request)
    {

        $this->validate($request,
        [
            'title' => 'required',
            'started_at' => 'required|date|after:tomorrow',
            'ended_at' => 'required|date|after:started_at',
            'description' => 'required',
            'post_type' => 'required|in:formation,stage',
            'category_id' => 'required|integer',
            'teachers' => 'array',
            'teachers.*' => 'int',
            'status' => 'in:published,unpublished',
            'picture' => 'image|mimes:jpg,png,jpeg',
            'price' => 'required|integer',
            'student_max' => 'required|integer',
        ]);


        //hydratation des données du Post enregistré en base de données
        $post = post::create($request->all());
        $post->teachers()->attach($request->teachers);

        $img = $request->file('picture');
        if(!empty($img)){

        //Méthode store retourne un link hash sécurisé
        $link = $request->file('picture')->store('./');
        //Mettre à jour la table picture pour le lien vers l'image dans la base de donnée
        $post->picture()->create([
        'link' => $link,
        // 'title' => $request->title_image?? $request->title
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
    public function update(Request $request, $id)
    {
        if(!($request['started_at'])AND(!($request['ended_at']))){

            unset($request['ended_at']);
            unset($request['started_at']);

            $this->validate($request,
            [
            'title' => 'required',
            'description' => 'required',
            'post_type' => 'required|in:formation,stage',
            'category_id' => 'required|integer',
            'teachers' => 'array',
            'teachers.*' => 'int',
            'status' => 'in:published,unpublished',
            'picture' => 'image|mimes:jpg,png,jpeg',
            'price' => 'required',
            'student_max' => 'required|integer',
            ]);

        }elseif(!($request['ended_at'])){
            
            unset($request['ended_at']);
            
            $this->validate($request,
            [
            'title' => 'required',
            'description' => 'required',
            'post_type' => 'required|in:formation,stage',
            'category_id' => 'required|integer',
            'teachers' => 'array',
            'teachers.*' => 'int',
            'status' => 'in:published,unpublished',
            'picture' => 'image|mimes:jpg,png,jpeg',
            'price' => 'required',
            'student_max' => 'required|integer',
            'started_at' => 'required|date|after:tomorrow',
            ]);

        }elseif(!($request['started_at'])){
            
            unset($request['started_at']);
            
            $this->validate($request,
            [
            'title' => 'required',
            'description' => 'required',
            'post_type' => 'required|in:formation,stage',
            'category_id' => 'required|integer',
            'teachers' => 'array',
            'teachers.*' => 'int',
            'status' => 'in:published,unpublished',
            'picture' => 'image|mimes:jpg,png,jpeg',
            'price' => 'required',
            'student_max' => 'required|integer',
            'ended_at' => 'required|date|after:started_at',
            ]);

        }else{

            $this->validate($request,
            [
            'title' => 'required',
            'description' => 'required',
            'post_type' => 'required|in:formation,stage',
            'category_id' => 'required|integer',
            'teachers' => 'array',
            'teachers.*' => 'int',
            'status' => 'in:published,unpublished',
            'picture' => 'image|mimes:jpg,png,jpeg',
            'price' => 'required',
            'student_max' => 'required|integer',
            'started_at' => 'required|date|after:tomorrow',
            'ended_at' => 'required|date|after:started_at',
            ]);
        }

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
        //
    }
}
