@extends('layouts.master')

@section('content')



<h1>Admin</h1>
@include('partials.menu')

  <div class='row'>
    
    @include('partials.searchbarback')
        @if($errors->has('q'))<span class="error" style="color : red;">{{$errors->first('q')}}</span>@endif
  </div>

   @include('back.post.partials.flash')

  <div class='row'>
    <div class="col-md-4">
    @if(isset($details))
      {{$details->appends(request()->only('q'))->links()}}
    </div>
    
    <div class="col-md-offset-4 col-md-2">
        <a href="{{route('post.create')}}"><button class="btn btn-primary create" >Ajouter un Post</button></a>
    </div>

    <div class='col-md-2'>
      <button class="btn btn-danger btn-md delete_all" data-url="{{ route('deleteAll')}}">
        Delete All Selected
      </button>
    </div>
  </div>

  <table class="table table-striped">
    <thead>
   
    <tr>
      <th><input type="checkbox" id="master"></th>
       <form action="{{route('post.sort')}}" method="post" class="formsort">
      {{csrf_field()}}
      <th scope="col"><a href="{{route('post.index')}}">Title</a>       
        <div class="input-group">
                <button type="submit form-control" name="title" value="titleAsc">
                    <span  class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="titleDesc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>

      <th scope="col"><a href="{{route('post.index')}}">Type</a>
        <div class="input-group">
                <button type="submit form-control" name="title" value="typeAsc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="typeDesc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>

      <th scope="col"><a href="{{route('post.index')}}">Category</a>
        <div class="input-group">
                <button type="submit form-control" name="title" value="catAsc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="catDesc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>

      <th scope="col"><a href="{{route('post.index')}}">Start</a>
        <div class="input-group">
                <button type="submit form-control" name="title" value="startAsc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="startDesc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>
      <th scope="col"><a href="{{route('post.index')}}">End</a>
        <div class="input-group">
                <button type="submit form-control" name="title" value="endAsc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="endDesc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>
      <th scope="col"><a href="{{route('post.index')}}">Price</a>
        <div class="input-group">
                <button type="submit form-control" name="title" value="priceAsc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="priceDesc">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true">
                    </span>
                </button>
        </div>
      </th>
      <th scope="col"><a href="{{route('post.index')}}">Status</a>
         <div class="input-group">
                <button type="submit form-control" name="title" value="StatusAsc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
                    </span>
                </button>
                <button type="submit form-control" name="title" value="StatusDesc">
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


    @forelse($details as $post)
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
           
      <form action="{{route('status', $post->id)}}" method="post">
      {{method_field('PUT')}}
      {{csrf_field()}}
      @if($post->status== 'published')
      <td style="color:green">
        <button  type="submit" class="btn btn-success btn-md">
        <input name="status" type="hidden"
        @if($post->status =='published')
        value="unpublished"
        @endif>
        published
      </button>
      </td>
      @else
      <td style="color:red">
        <button  type="submit" class="btn btn-warning btn-md">
        <input name="status" type="hidden"
        @if($post->status =='unpublished')
        value="published"
        @endif>unpublished
        </button>
      </td>
      @endif
      </form>

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
{{$details->appends(request()->only('q'))->links()}}
  @else
        <p>Aucun résultat ne correspond à votre recherche</p>     
        @endif 

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection
@section('scripts')
    @parent
    <script src="{{asset('js/deleteAll.js')}}"></script>
@endsection
  
@endsection