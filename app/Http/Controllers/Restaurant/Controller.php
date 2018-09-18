<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadImage(array &$data, $path = '/uploads'): void
    {
        if(isset($data['image'])){
            $image = $data['image'];
            $name = md5(time() . rand(0,9999)).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path($path);
            $image->move($destinationPath, $name);
            $data['image_path'] = "{$path}/{$name}";
        }
    }
}
