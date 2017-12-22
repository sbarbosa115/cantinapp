<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Upload and image into the app.
     * @param Request $request Request from the user.
     * @param string $path Optional location where the image will be.
     * @return string URI image with name.
     */
    public function uploadImage(Request $request, $path = '/uploads'){

        $image = $request->file('image');
        $name = md5(time() . rand(0,9999)).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path($path);
        $image->move($destinationPath, $name);

        return "{$path}/{$name}";
    }


}
