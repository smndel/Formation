@extends('layouts.master')

@section('content')
<h1>Admin</h1>
@include('partials.menu')

<div class='row' style='margin-left: auto;'>
<a href="#"><button>Ajouter un Post</button></a>
</div>

{{$posts->links()}}



<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Type</th>
      <th scope="col">Category</th>
      <th scope="col">Start</th>
      <th scope="col">End</th>
      <th scope="col">Status</th>
      <th scope="col">Teacher(s)</th>
      <th scope="col">Show</th>
      <th scope="col">Editer</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>


    @forelse($posts as $post)
    <tr>
      <td>{{$post->title}}</td>

      <td>{{$post->post_type}}</td>
      
      <td>{{$post->category->name}}</td>

      <td>{{$post->started_at}}</td>
      <td>{{$post->ended_at}}</td>
      
      @if($post->status== 'published')
      <td style="color:green">
      {{$post->status}}
      </td>
      @else
      <td style="color:red">
      {{$post->status}}
      </td>
      @endif
      
      <td>
      @forelse($post->teachers as $teacher)
      {{$teacher->name}}
      @empty
      @endforelse
      </td>

      <td><a href="#">voir</a></td>
      <td><a href="#">Editer</a></td>
      <td>
        DELETE
      </td>
    </tr>
    @empty
    @endforelse

  </tbody>
</table>
{{$posts->links()}}

<!-- Pour affichage du message de confirmation de suppression d'un livre -->
@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection
@endsection