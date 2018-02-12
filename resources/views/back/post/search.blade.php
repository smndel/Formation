@extends('layouts.master')

@section('content')



<h1>Admin</h1>
@include('partials.menu')

<div class='row' style='margin-left: auto;'>
<a href="{{route('post.create')}}"><button>Ajouter un Post</button></a>
</div>
@if(isset($details))

<button style="margin-bottom: 10px; float:right;" class="btn btn-primary delete_all" data-url="{{ route('deleteAll')}}">Delete All Selected</button>

@include('partials.searchbarback')
@include('back.post.partials.flash')

{{$details->appends(request()->only('q'))->links()}}
<table class="table table-striped">
  <thead>
    <tr>
      <th width="50px"><input type="checkbox" id="master"></th>
      <form action="{{route('post.searchsort', $details)}}" method="post">
      {{csrf_field()}}
      <th scope="col"><a href="{{route('post.index')}}">Title</a>       
        <div class="input-group">
                <button type="submit form-control" name="title" value="titleAsc">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true">
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
  </thead>
  <tbody>

@if(isset($details))
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
           
      <td>
      @forelse($post->teachers as $teacher)
      {{$teacher->name}}
      @empty
      @endforelse
      </td>
      
      @if($post->status== 'published')
      <td style="color:green">
      {{$post->status}}
      </td>
      @else
      <td style="color:red">
      {{$post->status}}
      </td>
      @endif

      <td><a href="{{route('post.show', $post->id)}}">voir</a></td>
      <td><a href="{{route('post.edit', $post->id)}}">Editer</a></td>
      <td>
        <form class="delete" action="{{route('post.destroy', $post->id)}}" method="POST">
           <input type="hidden" name="_method" value="DELETE">
           <input type="hidden" name="_token" value="{{ csrf_token() }}" />
           <input type="submit" value="Delete" style="background-color: #B35935; color: white;">
        </form>
      </td>
    </tr>
    @empty
    @endforelse
    @endif
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