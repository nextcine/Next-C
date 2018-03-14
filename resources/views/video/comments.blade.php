<hr>

		<h4>Comentarios </h4>

<hr>


<form class="col-md-4" method="post" action="">
	

		{!!csrf_field() !!}
	<input type="hidden" name="video_id" value="{{$video->id}}" required="">
		<p>
			<textarea class="form-control" name="body" required=""></textarea>
		</p>

	<input type="submit" value="Comentar" class="btn btn-success">


</form>