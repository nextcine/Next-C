@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="container">

            @if(session('message'))
              <div class="alert alert-success">
                    
                {{session('message')}}
              </div>
              @endif
              

              <div id="videos-list">
                
              @if(count($videos)>=1)
                @foreach($videos as $video)
                    <div class="video-item col-md-10 pull-left panel panel-default">
                        <div class=" panel-body">
                        <!-- imagen del video -->
                        @if(Storage::disk('images')->has($video->image))
                            <div class="video-image-thumb col-md-3 pull-left">
                                <div class="video-image-mask">
                                    <img src="{{url ('/miniatura/'.$video->image)}}" class="video-image">
                                </div>                                                
                            </div>
                        @endif
                        <div class="data">
                           <a href="{{route('detailVideo',['video_id'=>$video->id])}}" class="video-title"><h2 >{{$video->title}}</h2></a> 
                           <p>{{$video->user->name.''.$video->user->surname}}</p>
                        </div>

                        <!-- botones de acciones  -->
                      <a href="{{route('detailVideo',['video_id'=>$video->id])}}" class="btn btn-success">Ver</a>
                        @if(Auth::check() && Auth::user()->id == $video->user->id)
                           <a href="{{route('VideoEdit',['video_id'=>$video->id])}}" class="btn btn-warning">Editar</a>
                              
                               <!-- ventana modal para eliminar un video -->

                

                  <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                        <a href="#nextModal{{ $video->id }}" role="button" class="btn btn btn-danger" data-toggle="modal">Eliminar</a>
                          
                        <!-- Modal / Ventana / Overlay en HTML -->
                        <div id="nextModal{{ $video->id }}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">¿Estás seguro?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Seguro que quieres borrar este video?</p>
                                        <p class="text-warning"><strong> {{ $video->title }}</strong></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <a href="{{url('/delete-video/'.$video->id)}}"  type="button" class="btn btn-danger">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endif

                        </div>
                    </div>
                @endforeach

                @else
                <div class="alert alert-warning"> No hay resultados para su busqueda </div>
                @endif  
    
                    

              </div>
            

        </div>
    
              {{$videos->links()}}
    </div>
</div>
@endsection
