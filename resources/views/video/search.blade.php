


  @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="container">
			<div class="col-md-4"> 
            <h2>  <strong>Busqueda : </strong>  {{$search}}</h2>
            </div>
            <div class="col-md-8"> 
            <form class="col-md-4 pull-right" action="{{url('/buscar/'.$search)}}" method="">  
            	<label for="filter">Ordenar </label>
            	<select name="filter"	class="form-control">
						<option value="new">Mas nuevos primero </option>
						<option value="old"> mas antiguos primero</option>
						<option value="alfa">alfabeticamente </option>
            	</select>
            	<input class="btn btn-sm btn-success pull-right btn-default" type="submit" name="ordenar" value="ordenar">

            </form>
			</div>
			<div class="clearfix"> </div>
            @include('video.videosList')
          </div>
    </div>
</div>
@endsection