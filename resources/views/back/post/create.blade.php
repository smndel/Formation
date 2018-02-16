@extends('layouts.master')

@section('content')

<h1>Create Post:</h1>

@include('partials.menu')


<form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
    <!-- Token de sécurité : -->
    {{csrf_field()}}

<div class="col-md-6">

  {{--Titre--}}
    <div class="form-group">
    <label for="title">Titre :</label>
      <input type="text" class="form-control" placeholder="Titre du livre" id="title" name="title" value="{{old('title')}}">
      @if($errors->has('title'))
      <span class="error" style="color : red;">
        {{$errors->first('title')}}
      </span>
      @endif
    </div>

  {{--Description--}}
    <div class="form-group">
    <label for="description">Description :</label>
      <textarea type="textarea" class="form-control" id="description" name="description">{{old('description')}}</textarea>
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
        @if(old('status')=='stage') checked @endif 
        name="post_type" 
        value="stage" 
        checked> Stage <br>    
        <input 
        type="radio" 
        @if(old('status')=='formation') checked @endif 
        name="post_type" value="formation"> Formation<br>
    </div></br>

  {{--Catégorie--}}
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


  {{--Intervenants--}}
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

  {{--Ajouter un Post--}}
    <div class="form-group">
        <button type="submit" href="{{route('post.store')}}" class="col-md-6">Ajouter un Post</button>
    </div><br>
        
  {{--Date de début--}} 
    <div class="form-group">
     <label for="started_at" class="col-md-4 control-label">Date de début</label>
        <div class="input-group date form_datetime col-md-6" data-date-format="yyyy-mm-dd hh:ii:ss" data-link-field="started_at" style="padding:0 15px 0 15px;">
            <input class="form-control" size="16" type="text" value="{{old('started_at')}}" readonly style="background-color:#fff" name="started_at">
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
        <div class="input-group date form_datetime col-md-6" data-date-format="yyyy-mm-dd hh:ii:ss" data-link-field="ended_at" style="padding:0 15px 0 15px;">
            <input class="form-control" size="16" type="text" value="{{old('ended_at')}}" readonly style="background-color:#fff" name="ended_at">
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-remove"></span>
            </span>
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </span>
    </div>

      @if ($errors->has('ended_at'))
          <span class="help-block text-center">
              <strong>{{ $errors->first('ended_at') }}</strong>
          </span>
      @endif
    </div>


  {{--Nombre d'étudiant maximum--}}
    <div class="form-group">
        <label for="student_max">Nombre d'étudiants maximum : </label>
        <input type="number" name="student_max" id="student_max" min="1" max="50" value="{{old('student_max')}}">
        @if($errors->has('student_max'))
        <span class="error" style="color : red;">
        {{$errors->first('student_max')}}
      </span>
      @endif
    </div>
    
  {{--Prix--}}
    <div class="form-group">
        <label for="price">Prix : </label>
        <input type="number" name="price" id="price" min="1" max="2500" value="{{old('price')}}" step="any">T.T.C
        @if($errors->has('price'))
        <span class="error" style="color : red;">
        {{$errors->first('price')}}
      </span>
      @endif
    </div>

  {{--Status--}}
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

  {{--Image--}}
    <div class="form-group">
        <h2>File</h2>
        <input type="file" name="picture">
    </div>

</div>
</form>

@endsection