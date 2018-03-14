@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<h1>crear un video </h1>
		<form action="{{ route('saveVideo')}}" method="post" enctype="multipart/form-data" class="collg-7">
				{!!csrf_field() !!}

				@if($errors->any())

				<div class="alert alert-danger">
					
					<ul>
							@foreach($errors->all() as $error)
									<li>{{$error}}</li>
							@endforeach

					</ul>

				</div>

				@endif
			<div class="form-group"> 
				<label for="title">Titulo</label>
				<input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">

			</div>

				<div class="form-group"> 
				<label for="description">Descripcion</label>
				<textarea type="text" class="form-control" id="description" name="description"  >{{old('descripcion')}}</textarea>

			</div>


				<div class="form-group"> 
				<label for="image">Miniatura</label>
				<input type="file" class="form-control" id="image" name="image">

			</div>

			<div class="form-group"> 
				<label for="video">Archivo de video</label>
				<input type="file" class="form-control" id="video" name="video"/>

			</div>

			<button type="submit" class="btn btn-success">Crear Video</button>

		</form>

	</div>
	


</div>



@endsection