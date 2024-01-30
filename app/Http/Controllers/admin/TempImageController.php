<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\TempImage;
use Image;

class TempImageController extends Controller
{
    public function create(Request $request){
        $image= $request->image;
        if(!empty($image)){
            // if($request->image){
            // $image= $request->image;
            $ext=$image->getClientOriginalExtension();
            $newName = time().'.'.$ext;

            $tempImage =new TempImage();
            $tempImage->name= $newName;
            $tempImage->save();

            $image->move(public_path().'/temp',$newName);

            // gen img

            $sourcePath= public_path().'/temp/'.$newName;
            $destPath= public_path().'/temp/thumb/'.$newName;
            $image = Image::make($sourcePath);
            $image->fit(300,275);
            $image->save($destPath);
          

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'ImagePath' => asset('temp/thumb/'.$newName),
                'message'  => 'Image uploaded successfully'

            ]);

        }

    }
}
