<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Aimage;
use DB;

class AimageController extends Controller
{
    public function create(){
        return view('aimages.create');
    }

    public function store(Request $request)
    {
        if($request->hasFile('image')){

            $path = $request->file('image')->store('public/images', 's3');
            Storage::disk('s3')->setVisibility($path, 'private');
            $image=Aimage::create([
                'filename'=>basename($path),
                'url' => Storage::disk('s3')->url($path) 
                ]);
            return redirect()->route('aimg.show',$image);
            return $image;

        }else{
            dd('Hello~~');
        }
    }

    public function show(Aimage $image){
        // return $image->url;
        return Storage::disk('s3')->response('public/images/'.$image->filename);
    }
}
