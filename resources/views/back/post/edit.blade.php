@extends('layouts.master')

@section('content')

<h1>Edit Post:</h1>

@include('partials.menu')

<form action="{{route('post.update', $post)}}" method="post" enctype="multipart/form-data">
    <!-- Token de sécurité : -->
    {{method_field('PUT')}}
    {{csrf_field()}}

<div class="col-md-6">

    <div class="form-group">
    <label for="title">Titre :</label>
      <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
      @if($errors->has('title'))
      <span class="error" style="color : red;">
        {{$errors->first('title')}}
      </span>
      @endif
    </div>

    <div class="form-group">
    <label for="description">Description :</label>
      <textarea type="textarea" class="form-control" id="description" name="description">{{$post->description}}</textarea>
      @if($errors->has('description'))
      <span class="error" style="color : red;">
        {{$errors->first('description')}}
      </span>
      @endif
    </div>

    <div class="input-radio">
        <label for="post_type">Type : </label><br>
        <input 
        type="radio" 
        @if($post->post_type =='stage') checked @endif 
        name="post_type" 
        value="stage" 
        checked> Stage <br>    
        <input 
        type="radio" 
        @if($post->post_type =='formation') checked @endif 
        name="post_type" value="formation"> Formation<br>
    </div></br>
    
    <div class="form-group">
        <label for="category">Catégorie :</label>
        <select class="form-control" id="category_id" name="category_id">     
            <option value="0">No Category</option>
            @forelse($categories as $id => $category)  
            <option value="{{$id}}" 
            @if((($id)==$post->category_id)) selected='selected' @endif>{{$category}}</option>
            @empty
            @endforelse
        </select>
    </div>


        <div class="form-group">
        <label for="teachers">Choisissez un/des intervenant(s) :</label>
        <div class="form-group">
        @forelse($teachers as $id =>$name)
            <label class="control-label" ></label>
            <input 
            name="teachers[]" 
            type="checkbox" 
            value="{{$id}}" 
            id="teacher{{$id}}" 
            @forelse($post->teachers as $teacher)
            @if(($id) == $teacher->id) checked @endif
            @empty 
            @endforelse
            >{{$name}}
            @empty
            @endforelse
        </div> 
        </div>     
</div>

<div class="col-md-6">

    <div class="form-group">
        <button type="submit" class="col-md-6">Editer un Post</button>
    </div><br>
        
    <div class="form-group">
        <p>Date de début enregistré : {{$post->started_at}}</p>
        <label for="started_at">Nouvelle date de début :</label>
        <input type="datetime-local" name="started_at" value="{{$post->started_at}}">
        @if($errors->has('started_at'))
        <span class="error" style="color : red;">
        {{$errors->first('started_at')}}
        </span>
        @endif
    </div>

    <div class="form-group">
        <p>Date de fin enregistré : {{$post->ended_at}}</p>
        <label for="ended_at">Nouvelle date de fin :</label>
        <input type="datetime-local" name="ended_at" value="{{$post->ended_at}}">
        @if($errors->has('ended_at'))
        <span class="error" style="color : red;">
        {{$errors->first('ended_at')}}
      </span>
      @endif
    </div>    


    <div class="form-group">
        <label for="student_max">Nombre d'étudiants maximum : </label>
        <input type="number" name="student_max" id="student_max" min="1" max="50" value="{{$post->student_max}}">
        @if($errors->has('student_max'))
        <span class="error" style="color : red;">
        {{$errors->first('student_max')}}
      </span>
      @endif
    </div>
    
    <div class="form-group">
        <label for="price">Prix : </label>
        <input type="number" name="price" id="price" min="1" max="2500" value="{{$post->price}}" step="any">T.T.C
        @if($errors->has('price'))
        <span class="error" style="color : red;">
        {{$errors->first('price')}}
      </span>
      @endif
    </div>
        
    <div class="input-radio">
        <label for='status'>Status</label>
        <input 
        type="radio" 
        @if($post->status =='published') checked @endif 
        name="status" 
        value="published"> 
        publier<br>
        <input 
        type="radio" 
        @if($post->status =='unpublished') checked @endif 
        name="status" 
        value="unpublished">
        dépublier<br>
    </div>

    <div class="form-group">
        <label for="file">File</label>
        <input type="file" name="picture">
        @if(count($post->picture)>0)
        <img src="{{url('images', $post->picture->link)}}">
        @if($errors->has('picture'))
        <span class="error" style="color : red;">
        {{$errors->first('picture')}}
        </span>
        @endif
    @endif
    </div>

</div>

</form>
  


@endsection