@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">



<h1>Admin</h1>
@include('partials.menu')

<div class='row' style='margin-left: auto;'>
<a href="{{route('post.create')}}"><button>Ajouter un Post</button></a>
</div>

{{$posts->links()}}
<button style="margin-bottom: 10px; float:right;" class="btn btn-primary delete_all" data-url="{{ route('deleteAll')}}">Delete All Selected</button>

@include('back.post.partials.flash')

<table class="table table-striped">
  <thead>
    <tr>
      <th width="50px"><input type="checkbox" id="master"></th>
      <th scope="col">Title</th>
      <th scope="col">Type</th>
      <th scope="col">Category</th>
      <th scope="col">Start</th>
      <th scope="col">End</th>
      <th scope="col">Price</th>
      <th scope="col">Teacher(s)</th>
      <th scope="col">Status</th>
      <th scope="col">Show</th>
      <th scope="col">Editer</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>


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

  </tbody>
</table>
{{$posts->links()}}

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection
@section('scripts')
    @parent
    <script src="{{asset('js/deleteAll.js')}}"></script>
@endsection

@endsection