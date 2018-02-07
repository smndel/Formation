@extends('layouts.master')

@section('content')
<h1>RECHERCHE</h1>
<div class="row">
    <div class="col-md-8">
        @include('partials.menu')
        
        @if(isset($details))
            {{$details->appends(request()->only('q'))->links()}}
        <p> Le(s) résultat(s) de votre recherche sur "<b> {{ $query }} </b>" sont :</p>
        <ul class="list-group">
        @forelse($details as $post)
            <li class="list-group-item">
                <h2><a href="{{route('show', $post->id)}}">{{$post->title}}</a></h2>
        
                    <h3><i>{{ucfirst($post->post_type)}}</i></h3>

                    <h3>Catégorie : {{$post->category->name}}</h3>

                    <div class="row">

                        <div class="col-md-6"> 
                            <div>
                                @if(count($post->picture)>0)
                                <img class="img-thumbnail " src="{{url('images', $post->picture->link)}}" style="width: 300px">
                                @endif
                            </div>
                                <h4>Coût de la formation :</h4>
                                    <p>{{$post->price}} Euros T.T.C</p>
                                <h4>Nombre de places disponibles :</h4>
                                    <p>{{$post->student_max}}</p>
                        </div>


                        <div class="col-md-6">
                            <h4>Description :</h4>
                                <p>{{$post->description}}</p>
                            <h4>Dates :</h4>
                                <p>Commence le : {{$post->started_at}}</p>
                                <p>Fini le : {{$post->ended_at}}</p>
                            <h4>Le(s) Intervenant(s):</h4>
                                <ul>
                                    @foreach($post->teachers as $teacher)
                                    <li>{{$teacher->name}}</li>
                                    @endforeach
                                </ul>
                        </div>
                    </div>
            </li>
        @empty
        @endforelse 
        </ul>
          {{$details->appends(request()->only('q'))->links()}}
        @else
        <p>Aucun résultat ne correspond à votre recherche</p>     
        @endif 
    </div>

    <div class="col-md-4">
        <form action="{{route('search')}}" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="q"
                    placeholder="Recherche" style="height: 50px;"> <span class="input-group-btn">
                    <button type="submit" class="btn btn-default" style="height: 50px;">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>
@endsection