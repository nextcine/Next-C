<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Reponse;
use App\Http\Controllers\File;

use App\Video;
use App\Comment; 

class VideoController extends Controller
{
    public function createvideo(){



    	return view('video.createVideo');
    }
    public function saveVideo(Request $request){

    		// validar el formulario de subida de videos 

    $validateData =$this->validate( $request,[

	    	'title' => 'required|min:5',
	    	'description' => 'required',
	    	'video_path' => 'mimes:mp4,mov,ogg,qt',


    ]); 
    	$video = new Video(); 
    	$user = \Auth::user(); 
    	$video->user_id = $user->id;  
    	$video->title = $request->input('title');  
    	$video->description = $request->input('description');  


    	// subida de la miniatura de cada video 

    	$image = $request->file('image'); 
    	if ($image) {
    		$image_path = $image->getClientOriginalName();
    		\Storage::disk('images')->put($image_path, \File::get($image)); 

    		$video->image = $image_path; 
    	}

    		// subir video o pelicula o serie 

    	$video_file = $request->file('video');

    	if ($video_file) {
    		$video_path = time().$video_file->getClientOriginalName();
    		\Storage::disk('videos')->put($video_path, \File::get($video_file)); 

    		$video->video_path= $video_path; 
    	}



    	$video->save(); 
    	return redirect()->route('home')->with(array(


    		'message'=> 'El video se guardo correctamente !!'


    	)); 

    }

    public function getImage($filename){

    	$file  = Storage::disk('images')->get($filename);

    	// NO se crea un nuevo objeto response 
    	return  Response($file, 200);


    }

    public function getVideoDetail($video_id){

    		$video = Video::find($video_id); 

    		return view('video.detail',array(

    			'video'=> $video 

    		));

    }

    public function getVideo($filename){



    	$file = Storage::disk('videos')->get($filename);
    	return  Response($file,200);
    }


    public function delete($video_id){

            $user = \Auth::user();
            $video =Video::find($video_id);
            $comments =Comment::where('video_id',$video_id)->get();

            if ($user && $video->user_id = $user->id) {
                

                // elimina los comentarios relacionados a cada video
                if ( $comments && count($comments)>=1 ) {
                    foreach ($comments as $comment) {
                        $comment->delete();
                    }
                    
                }
               

                Storage::disk('images')->delete($video->image);
                Storage::disk('videos')->delete($video->video_path);

                    // elimina el registro del video

                $video->delete();

                $message =array('message'=>'Video eliminado correctamente');
            }else{

                $message = array ('message'=> 'El video no se a podido eliminar ');

            }
                        // se redirige al home despues de haber eliminado el video
            return redirect()->route('home')->with($message);


    }


    public function edit($id){
            $user = \Auth::user();
            $video = Video::findorFail($id);

            if ($user && $video->user_id = $user->id) {

               
                return view('video.edit',array('video'=>$video)); 
        }else{

            return redirect()->route('home');
        }

    }

    public function update($video_id, Request $request){

              $validateData =$this->validate( $request,[

                    'title' => 'required|min:5',
                    'description' => 'required',
                    'video_path' => 'mimes:mp4,mov,ogg,qt',


            ]); 

            $user = \Auth::user();
            $video = Video::findOrfail($video_id); 
            $video->user_id = $user->id;
            $video->title = $request->input('title');
            $video->description= $request->input('description'); 



            // subida de la miniatura de cada video 

            $image = $request->file('image'); 
            if ($image) {
                $image_path = $image->getClientOriginalName();
                \Storage::disk('images')->put($image_path, \File::get($image)); 

                $video->image = $image_path; 
            }

                // subir video o pelicula o serie 

            $video_file = $request->file('video');

            if ($video_file) {
                $video_path = time().$video_file->getClientOriginalName();
                \Storage::disk('videos')->put($video_path, \File::get($video_file)); 

                $video->video_path= $video_path; 
            }


                $video->update(); 

                return redirect()->route('home')->with(array('message'=>'El video se a actualizado correctamente '));

    }

    public function search($search = null){

        if (is_null($search)) {
           $search = \Request::get('search');

                   }


            $videos =Video::where('title','LIKE', '%'.$search.'%')->paginate(5);

            return view('video.search',array(

                    'videos' => $videos,
                    'search'=> $search

            ));

    }
}
