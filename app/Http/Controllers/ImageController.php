<?php

namespace App\Http\Controllers;
use Image as IntervesionImage;

use Illuminate\Http\Request;
use App\Image;
use App\Album;
//use Image as IntervesionImage;

class ImageController extends Controller
{
    public function __construct(){
       // $this->middleware('admin', ['only' => ['index', 'addImage','destroy','store','albumImage']]);

   }
    public function index()
    {
        $images=Image::get();
 
        return view('home',compact('images'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'album'=>'required|min:3|max:20',
            'image'=>'required'
        ]);

       $album=Album::create(['name'=>$request->get('album')]);
      
       if($request->hasFile('image')){
           //looping through multiple image gotten from form
           foreach($request->file('image') as $image){
               $path=$image->store('uploads','public');
                 Image::create([
                    'name'=>$path,
                    'album_id'=>$album->id
                ]);
           }
           
       }
       return "<div class='alert alert-success'> Album created
       successfully!</div>";
    }
    public function album()
    {
        $albums=Album::with('images')->get();
        return view('welcome',compact('albums'));
    
    }
    public function show($id){
       $albums=Album::findOrFail($id);
       return view('gallery',compact('albums'));
       
    }
    public function destroy(Request $request)
    {
        $id=$request->get('id');
        $image=Image::findOrFail($id);
        $filename = $image->name;
        $image->delete();
        \Storage::delete('public/'.$filename);
        return redirect()->back()->with('message','Image deleted successfully!');

    }
    public function addImage(Request $request)
    { 
        $albumId=$request->get('id');
       if($request->hasFile('image')){
           //looping through multiple image gotten from form
           foreach($request->file('image') as $image){
               $path=$image->store('uploads','public');
                 Image::create([
                    'name'=>$path,
                    'album_id'=>$albumId
                ]);
           }
           
       }
       return redirect()->back()->with('message','Image added successfully!');

    }
    public function albumImage(Request $request){
        $this->validate($request,[
            'image'=>'required'
        ]);
        $albumId= $request->get('id');
        if($request->hasFile('image')){
                $file = $request->file('image');
                $path = $file->store('uploads','public');
                Album::where('id',$albumId)->update([
                    'image'=> $path,
                ]);
            }
        
        return redirect()->back()->with('message','Album images added successfully!');
    }

    /*Image Resize */
    public function upload(){
        $albums = Album::get();
        return view('upload',compact('albums'));
    }
    /*Image Resize */
    public function postUpload(Request $request){
        if($request->hasFile('image')){
                $file = $request->file('image');
                $filename = time().'.'.$file->getClientOriginalExtension();

               $img=IntervesionImage::make($file)->resize(100,100);
               $img->save('avatars/'.$filename);
               
               $img_album=new Album();
               $img_album->name="resize image";
               $img_album->image=$filename;
               $img_album->save();
                /*Album::create([
                    'image'=>$filename,
                    'name'=>'resizing image'
                ]);*/
                return back();
        }
    }


}
