@extends('layouts.master')

@section('content')

<h1>Edit Post:</h1>

@include('partials.menu')

<form action="{{route('post.update', $post)}}" method="post" enctype="multipart/form-data">
    <!-- Token de sécurité : -->
    {{method_field('PUT')}}
    {{csrf_field()}}

<div class="col-md-6">

  {{--Titre--}}
    <div class="form-group">
    <label for="title">Titre :</label>
      <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
      @if($errors->has('title'))
      <span class="error" style="color : red;">
        {{$errors->first('title')}}
      </span>
      @endif
    </div>

  {{--Description--}}
    <div class="form-group">
    <label for="description">Description :</label>
      <textarea type="textarea" class="form-control" id="description" name="description">{{$post->description}}</textarea>
      @if($errors->has('description'))
      <span class="error" style="color : red;">
        {{$errors->first('description')}}
      </span>
      @endif
    </div>

  {{--Type--}}
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
    
  {{--Catégorie--}}
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

  {{--Intervenants--}}
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

  {{--Editer un Post--}}
    <div class="form-group">
        <button type="submit" class="col-md-6">Editer un Post</button>
    </div><br>
        
  {{--Date de début--}}      
     <div class="form-group">
        <label for="started_at" class="col-md-4 control-label">Date de début</label>
        <div class="input-group date form_datetime col-md-6" data-date="2018-01-1T00:00:00Z" data-date-format="yyyy-mm-dd hh:ii:ss" data-link-field="started_at" style="padding:0 15px 0 15px;">
            <input class="form-control" size="16" type="text"
            @if (!null == old('started_at'))
              value="{{old('started_at')}}"
            @else
              value="{{$post->started_at}}"
            @endif
            readonly style="background-color:#fff" name="started_at">
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-remove"></span>
            </span>
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </span>
        </div>

      @if ($errors->has('started_at'))
          <span class="help-block text-center">
              <strong>{{ $errors->first('started_at') }}</strong>
          </span>
      @endif
    </div>

  {{-- Date de fin --}}
    <div class="form-group">
        <label for="ended_at" class="col-md-4 control-label">Date de fin</label>
        <div class="input-group date form_datetime col-md-6" data-date="2018-01-1T00:00:00Z" data-date-format="yyyy-mm-dd hh:ii:ss" data-link-field="ended_at" style="padding:0 15px 0 15px;">
            <input class="form-control" size="16" type="text"
            @if (!null == old('ended_at'))
              value="{{old('ended_at')}}"
            @else
              value="{{$post->ended_at}}"
            @endif
             readonly style="background-color:#fff" name="ended_at">
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-remove"></span>
            </span>
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </span>
        </div><br>  

  {{--Nombre d'étudiant maximum--}}
    <div class="form-group">
        <label for="student_max">Nombre d'étudiants maximum : </label>
        <input type="number" name="student_max" id="student_max" min="1" max="50" value="{{$post->student_max}}">
        @if($errors->has('student_max'))
        <span class="error" style="color : red;">
        {{$errors->first('student_max')}}
      </span>
      @endif
    </div>
    
  {{--Prix--}}
    <div class="form-group">
        <label for="price">Prix : </label>
        <input type="number" name="price" id="price" min="1" max="2500" value="{{$post->price}}" step="any">T.T.C
        @if($errors->has('price'))
        <span class="error" style="color : red;">
        {{$errors->first('price')}}
      </span>
      @endif
    </div>
      
  {{--Status--}}
    <div class="input-radio">
        <label for='status'>Status</label><br>
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
    </div><br>

  {{--Image--}}
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