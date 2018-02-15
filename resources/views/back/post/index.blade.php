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
      {{$posts->appends(request()->only('title'))->links()}}
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
      <th>
        <input type="checkbox" id="master">
      </th>
       <form action="{{route('post.sort')}}" method="post">
        {{csrf_field()}}

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
           
      <td class="text-center"><input type="checkbox" class="checkbox published" data-id="{{$post->id}}" @if ($post->status == 'published') checked @endif></td>

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

<script>
        $(document).ready(function(){
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $('.published').click(function(event){

            event.preventDefault();
            
            console.log($(this).data('id')) 

                id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('changeStatus') }}",
                    data: {
                        'id': id
                    },
                    success: function(data) {

                        $('.checkbox').each(function(index){
                          let $id = $(this).data('id')

                          if( data['id'] === $id  ){
                            if ( $(this).is( ":checked" ) ) $(this).prop('checked', false)
                            else 
                              $(this).prop('checked', true)

                          }

                        })

                    },
                });
            });
        });
</script>

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/deleteAll.js')}}"></script>
@endsection
  
@endsection