@extends('layouts.master')

@section('content')
<h1>FORMATIONS NUMERIQUES</h1>
@include('partials.menu')
        <h2>{{$post->title}}</h2>
        
        <h3><i>{{ucfirst($post->post_type)}}</i></h3>

        <h3>Catégorie : {{$post->category->name}}</h3>

        <div class="row">

            <div class="col-md-6"> 
                <div>
                @if(count($post->picture)>0)
                <img class="img-thumbnail " src="{{url('images', $post->picture->link)}}" style="width: 300px">
                @endif
                </div>
                <h4>Dates :</h4>
                <p>Commence le : {{$post->started_at}}</p>
                <p>Fini le : {{$post->ended_at}}</p>
                <h4>Coût de la formation :</h4>
                <p>{{$post->price}} Euros T.T.C</p>
                <h4>Nombre de places disponibles :</h4>
                <p>{{$post->student_max}}</p>
            </div>

             <div class="col-md-6">
                <h4>Description :</h4>
                <p>{{$post->description}}</p>
                <h4>Le(s) Intervenant(s):</h4>
                <ul>
                @foreach($post->teachers as $teacher)
                <li>{{$teacher->name}}</li>
                @endforeach
                </ul>

            </div>
            
            

           
        </div>

 
@endsection