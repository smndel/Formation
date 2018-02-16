@extends('layouts.master')

@section('content')

@include('partials.menu')
<div class="col-md-6"> 
    <h1>Title : <i>{{$post->title}}</i></h1>

    @if(isset($post->category->name))
        <p><strong>Categorie : </strong>{{$post->category->name}}</p> 
    @else
        <p><strong>Categorie : </strong>Pas de catégorie</p> 
    @endif

        <p><strong>Type : </strong>{{$post->post_type}}</p>

        <p><strong>Date de début : </strong>{{$post->started_at}}</p> 

        <p><strong>Date de fin : </strong>{{$post->ended_at}}</p>

        <p><strong>Prix : </strong>{{$post->price}}</p> 

        <p><strong>Nombre d'étudiants maximum : </strong>{{$post->student_max}}</p> 
        
        <p><strong>Status : </strong>{{$post->status}}</p>

    <h3>Description :</h3>
        <p>{{$post->description}}</p>

     <h2>Les Intervants :</h2>
        <ul>
            <strong>Nombre d'intervenant(s) : </strong>{{count($post->teachers)}}
                @forelse($post->teachers as $teacher)
                    <li>{{$teacher->name}}</li>
                @empty
                @endforelse
        </ul>


</div>


<div class="col-md-6"> 
    
    <h2>Image :</h2>
        @if(isset($post->picture->link))
            <img src="{{url('images', $post->picture->link)}}" style="width: 300px">
        @else
            <p>Pas d'image</p>
        @endif
</div>

        


                   
        


@endsection