<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class ImageController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('imageupload');
    }

    public function store(Request $request)
    {
        if($request->hasFile('profile_image')) {

            //get filename with extension
            $filenamewithextension = $request->file('profile_image')->getClientOriginalName();
    
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
    
            //small thumbnail name
            $smallthumbnail = $filename.'_small_'.time().'.'.$extension;
    
            //medium thumbnail name
            $mediumthumbnail = $filename.'_medium_'.time().'.'.$extension;
    
            //large thumbnail name
            $largethumbnail = $filename.'_large_'.time().'.'.$extension;
    
            //Upload File
            $request->file('profile_image')->storeAs('public/profile_images', $filenametostore);
            $request->file('profile_image')->storeAs('public/profile_images/thumbnail', $smallthumbnail);
            $request->file('profile_image')->storeAs('public/profile_images/thumbnail', $mediumthumbnail);
            $request->file('profile_image')->storeAs('public/profile_images/thumbnail', $largethumbnail);
    
            //create small thumbnail
            $smallthumbnailpath = public_path('storage/profile_images/thumbnail/'.$smallthumbnail);
            $this->createThumbnail($smallthumbnailpath, 150, 93);
    
            //create medium thumbnail
            $mediumthumbnailpath = public_path('storage/profile_images/thumbnail/'.$mediumthumbnail);
            $this->createThumbnail($mediumthumbnailpath, 300, 185);
    
            //create large thumbnail
            $largethumbnailpath = public_path('storage/profile_images/thumbnail/'.$largethumbnail);
            $this->createThumbnail($largethumbnailpath, 550, 340);
    
            return redirect('img')->with('success', "Image uploaded successfully.");
        }
    }

    /**
     * Create a thumbnail of specified size
     *
     * @param string $path path of thumbnail
     * @param int $width
     * @param int $height
     */
    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

    public function test()
    {
        $src = "https://d19kzigy6tpscu.cloudfront.net/media/boutique/index/2019/06/13/Gabriel__Co._HB4ZF.jpg";
        $image = Image::make($src)->resize(300, 200);
        $tgt = "storage/hoo1.jpg";
        $image->save($tgt);
    }
}
