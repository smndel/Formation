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
        <a href="{{route('post.create')}}"><button class="btn btn-primary create">Ajouter un Post</button></a>
    </div>

    <div class='col-md-2'>
      <button class="btn btn-danger btn-md delete_all" data-url="{{ route('deleteAll')}}">
        Delete All Selected
      </button>
    </div>
  </div>

  <p> Le(s) résultat(s) de votre recherche sur "<b> {{ $query }} </b>" sont :</p>

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
        <th scope="col">Status</th>
        <th scope="col">Show</th>
        <th scope="col">Editer</th>
        <th scope="col">Delete</th>
      </tr>
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
           
      <td class="text-left">
        <label class="custom-control custom-checkbox">
          <input  type="checkbox" 
                  class="checkbox published custom-control-input" 
                  data-id="{{$post->id}}" 
                  @if ($post->status == 'published') checked @endif>
          <span class="custom-control-indicator"></span>
        </label>
        <p class="status">{{$post->status}}</p>

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


  
@endsection