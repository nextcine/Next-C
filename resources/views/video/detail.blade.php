@extends('layouts.app')

@section('content')

<div class="col-md-5 col-md-offset-0">
		 <h2>{{$video->title}}</h2>
		<hr>

		<div class="col-md-8">
			
			<video controls id="video-player">

				<source src="{{route('fileVideo',['filename'=> $video->video_path])}}" >
				
					Tu navegador no es compatible con HTML5

			</video>
			<!-- descripcion -->

			<div class="panel panel-default video-data">
				
				<div class="panel-heading">
					<div class="panel-title">
						Video Subido por <strong>{{$video->user->name.''.$video->user->surname}}</strong> <br> Creado : 

						<!-- se formatea la fecha con un helper -->

						 {{ \FormatTime::LongTimeFilter($video->created_at) }}
					</div>
									
				</div>
				<div class="panel-body">
					{{ $video->description}}
						

				</div>
					

			</div>
		</div>

</div>

@endsection