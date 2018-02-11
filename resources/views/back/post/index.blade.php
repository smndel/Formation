@extends('layouts.master')

@section('content')

<h1>Admin</h1>
  @include('partials.menu')

  <div class='row'>
    <div class="col-md-6">
        <a href="{{route('post.create')}}"><button style="height: 50px;">Ajouter un Post</button></a>
    </div>
    @include('partials.searchbarback')
        @if($errors->has('q'))<span class="error" style="color : red;">{{$errors->first('q')}}</span>@endif

  </div>


  <div class='row'>
  <button class="btn btn-primary delete_all" data-url="{{ route('deleteAll')}}">Delete All Selected</button>



@include('back.post.partials.flash')
{{$posts->appends(request()->only('title'))->links()}}
</div>
<table class="table table-striped">
  <thead>
    <form action="{{route('post.sort')}}" method="post">
      {{csrf_field()}}
    <tr>
      <th width="50px"><input type="checkbox" id="master"></th>

      <th scope="col">Title       
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

      <th scope="col">Type
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

      <th scope="col">Category
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

      <th scope="col">Start
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
      <th scope="col">End
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
      <th scope="col">Price
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
      <th scope="col">Status</th>
      <th scope="col">Show</th>
      <th scope="col">Editer</th>
      <th scope="col">Delete</th>
    </tr>
    </form>
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
{{$posts->appends(request()->only('title'))->links()}}

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection
@section('scripts')
    @parent
    <script src="{{asset('js/deleteAll.js')}}"></script>
@endsection
  
@endsection