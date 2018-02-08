@extends('layouts.master')
@section('content')
<h1>CONTACT</h1>
	@include('partials.menu')
	  <div class="container">
	@if(session('message'))
	<div class='alert alert-success'>
		{{ session('message') }}
	</div>
	@endif
	
	<div class="col-12 col-md-8">
		<form class="form-horizontal" method="POST" action="/contact">
			{{ csrf_field() }} 
			<div class="form-group">
			<label for="Name">Nom: </label>
			<input type="text" class="form-control" id="name" placeholder="Votre nom" name="name" value="{{old('name')}}">
			@if($errors->has('name'))<span class="error" style="color : red;">{{$errors->first('name')}}</span>@endif
		</div>

		<div class="form-group">
			<label for="email">Email: </label>
			<input type="text" class="form-control" id="email" placeholder="john@example.com" name="email" value="{{old('email')}}">
			@if($errors->has('email'))<span class="error" style="color : red;">{{$errors->first('email')}}</span>@endif
		</div>

		<div class="form-group">
			<label for="message">message: </label>
			<textarea type="text" class="form-control luna-message" id="message" placeholder="Taper votre message ici" name="message"></textarea>
			@if($errors->has('message'))<span class="error" style="color : red;">{{$errors->first('message')}}</span>@endif
		</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary" value="Send">Send</button>
			</div>
		</form>
	</div>
 </div>
@endsection
