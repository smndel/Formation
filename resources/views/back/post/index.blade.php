@extends('layouts.master')

@section('content')

<h1>Admin</h1>
  @include('partials.menu')

  {{-- Barre de recherche --}}
  <div class='row'>
    @include('partials.searchbarback')
        @if($errors->has('q'))<span class="error" style="color : red;">{{$errors->first('q')}}</span>@endif
  </div>

   @include('back.post.partials.flash')

  <div class='row'>
    <div class="col-md-4">
      {{$posts->appends(request()->only('title'))->links()}}
    </div>
    
  {{-- Ajouter un Post --}}
    <div class="col-md-offset-4 col-md-2">
        <a href="{{route('post.create')}}"><button class="btn btn-primary create" >Ajouter un Post</button></a>
    </div>


  {{-- Bouton Delete All --}}
    <div class='col-md-2'>
      <button class="btn btn-danger btn-md delete_all" data-url="{{ route('deleteAll')}}">
        Delete All Selected
      </button>
    </div>
  </div>

  <table class="table table-striped">
    <thead>
   
    <tr>

      {{-- Input pour le Delete All --}}
      <th>
        <input type="checkbox" id="master">
      </th>

      {{-- Formulaire pour le Tri du tableau  --}}
       <form action="{{route('post.sort')}}" method="post">
        {{csrf_field()}}

      {{-- Tri par Titre --}}
      <th scope="col"><a href="{{route('post.index')}}">Title</a>
        <div class="input-group">
                <button type="submit form-control" name="title" value="title.asc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="title.desc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>

      {{-- Tri par type --}}
      <th scope="col"><a href="{{route('post.index')}}">Type</a>
        <div class="input-group">
                <button type="submit form-control" name="title" value="post_type.asc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="post_type.desc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>
  
      {{-- Tri par catégories --}}
      <th scope="col"><a href="{{route('post.index')}}">Category</a>
        <div class="input-group">
                <button type="submit form-control" name="title" value="category_id.asc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="category_id.desc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>

      {{-- Tri par Date de début--}}
      <th scope="col"><a href="{{route('post.index')}}">Start</a>
        <div class="input-group">
                <button type="submit form-control" name="title" value="started_at.asc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="started_at.desc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>

      {{-- Tri par Date de fin--}}
      <th scope="col"><a href="{{route('post.index')}}">End</a>
        <div class="input-group">
                <button type="submit form-control" name="title" value="ended_at.asc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="ended_at.desc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>

      {{-- Tri par Prix--}}
      <th scope="col"><a href="{{route('post.index')}}">Price</a>
        <div class="input-group">
                <button type="submit form-control" name="title" value="price.asc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="price.desc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>

      {{-- Tri par Status--}}
      <th scope="col"><a href="{{route('post.index')}}">Status</a>
         <div class="input-group">
                <button type="submit form-control" name="title" value="status.asc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="status.desc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>
      <th scope="col">Show</th>
      <th scope="col">Editer</th>
      <th scope="col">Delete</th>
    </tr>
    </form>
  </thead>

  <tbody>

    {{-- Remplissage du tableau--}}
    @forelse($posts as $post)
    <tr>
      <td><input type="checkbox" class="sub_chk" data-id="{{$post->id}}"></td>

      <td>{{$post->title}}</td>

      <td>{{$post->post_type}}</td>
      
      @if(isset($post->category->name))
      <td>{{$post->category->name}}</td>
      @else
      <td>No category</td>
      @endif

      <td>{{$post->started_at}}</td>
      
      <td>{{$post->ended_at}}</td>

      <td>{{$post->price}}</td>
           
      <td class="text-left">
        <label class="custom-control custom-checkbox">
          <input  type="checkbox" 
                  class="checkbox published custom-control-input" 
                  data-id="{{$post->id}}" 
                  @if ($post->status == 'published') checked @endif>
          <span class="custom-control-indicator"></span>
        </label>
        <p class="status">{{$post->status}}</p>
      </td>

      <td>
        <a href="{{route('post.show', $post->id)}}">
          <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
        </a>
      </td>

      <td>
        <a href="{{route('post.edit', $post->id)}}">
          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        </a>
      </td>

      <td>
        <form class="delete" action="{{route('post.destroy', $post->id)}}" method="POST">
           <button type="submit" class="btn btn-danger btn-md" value="delete"><i class="fa fa-times"> Delete</button>
           <input type="hidden" name="_method" value="DELETE">
           <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        </form>
      </td>

    </tr>
    @empty
    @endforelse
  </tbody>
</table>

{{$posts->appends(request()->only('title'))->links()}}

@endsection