<?php

namespace App\Http\Controllers;

use App\Image;
use App\Jobs\ProcessImageThumbnail;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view('upload.form');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'demo_image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $image = $request->file('image');
        $input['demo_image'] = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['demo_image']);

        $image = new Image();
        $image->org_path = 'image' . DIRECTORY_SEPARATOR . $input['demo_image'];

        $image->save();

        ProcessImageThumbnail::dispatch($image);

        return redirect(route('image'))->with(['message' => 'image upload succesfully']);
    }
}
