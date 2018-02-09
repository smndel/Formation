@extends('layouts.master')

@section('content')

<h1>Create Post:</h1>
@include('partials.menu')
<form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
    <!-- Token de sécurité : -->
    {{csrf_field()}}

<div class="col-md-6">

    <div class="form-group">
    <label for="title">Titre :</label>
      <input type="text" class="form-control" placeholder="Titre du livre" id="title" name="title" value="{{old('title')}}">
      @if($errors->has('title'))
      <span class="error" style="color : red;">
        {{$errors->first('title')}}
      </span>
      @endif
    </div>

    <div class="form-group">
    <label for="description">Description :</label>
      <textarea type="textarea" class="form-control" id="description" name="description">{{old('description')}}</textarea>
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
        @if(old('status')=='stage') checked @endif 
        name="post_type" 
        value="stage" 
        checked> Stage <br>    
        <input 
        type="radio" 
        @if(old('status')=='formation') checked @endif 
        name="post_type" value="formation"> Formation<br>
    </div></br>
    
    <div class="form-group">
    <label for="category">Catégorie :</label>
    <select class="form-control" id="category_id" name="category_id">     
        <option value="0">No Category</option>
        @forelse($categories as $id => $category)  
        <option value="{{$id}}" @if(old('category_id') == $id) {{'selected'}} @endif>{{$category}}</option>
        @empty
        @endforelse
    </select>
    </div>

<h2>Choisissez un/des intervenant(s) :</h2>

        <div class="form-group">
        @forelse($teachers as $id =>$name)
        <label class="control-label" >{{$name}}</label>
        <input 
        name="teachers[]" 
        type="checkbox" 
        value="{{$id}}" 
        id="teacher{{$id}}" 
        {{ ( !empty(old('teachers')) and in_array($id, old('teachers')) )? 'checked' : ''  }}>

        @empty
        @endforelse
        </div>
</div>

<div class="col-md-6">

    <div class="form-group">
        <button type="submit" href="{{route('post.store')}}" class="col-md-6">Ajouter un Post</button>
    </div><br>
        
    <div class="form-group">
        <label for="started_at">Début :</label>
        <input type="datetime-local" name="started_at" value="{{old('started_at')}}">
        @if($errors->has('started_at'))
        <span class="error" style="color : red;">
        {{$errors->first('started_at')}}
      </span>
      @endif
    </div>

    <div class="form-group">
        <label for="ended_at">Fin :</label>
        <input type="datetime-local" name="ended_at" value="{{old('ended_at')}}">
        @if($errors->has('ended_at'))
        <span class="error" style="color : red;">
        {{$errors->first('ended_at')}}
      </span>
      @endif
    </div>    


    <div class="form-group">
        <label for="student_max">Nombre d'étudiants maximum : </label>
        <input type="number" name="student_max" id="student_max" min="1" max="50" value="{{old('student_max')}}">
        @if($errors->has('student_max'))
        <span class="error" style="color : red;">
        {{$errors->first('student_max')}}
      </span>
      @endif
    </div>
    
    <div class="form-group">
        <label for="price">Prix : </label>
        <input type="number" name="price" id="price" min="1" max="2500" value="{{old('price')}}" step="any">T.T.C
        @if($errors->has('price'))
        <span class="error" style="color : red;">
        {{$errors->first('price')}}
      </span>
      @endif
    </div>
        
    <div class="input-radio">
        <h2>Status</h2>
        <input 
        type="radio" 
        @if(old('status')=='published') checked @endif 
        name="status" 
        value="published" 
        checked> publier<br>
        <input 
        type="radio" 
        @if(old('status')=='unpublished') checked @endif 
        name="status" value="unpublished"> dépublier<br>
    </div>

    <div class="form-group">
        <h2>File</h2>
        <input type="file" name="picture">
    </div>

</div>
</form>
@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>  
@endsection

@endsection