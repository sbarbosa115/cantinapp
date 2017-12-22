<?php

namespace App\Http\Controllers\Restaurant;

use App\Product;
use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Validator;

class HomeController extends Controller
{

    /**
     *
     */
    public function index(){
        $restaurants = Restaurant::all();
        return view('restaurant.home.index', compact($restaurants));
    }

    /**
     *
     */
    public function create(){
        return view('restaurant.home.create');
    }


    /**
     * Store validate and store a product in database.
     * @param Request $request User request object.
     * @return Redirect if all is good to controller index otherwise self-redirect with errors.
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image'
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }

        $image = $this->uploadImage($request);
        $data = $request->all();
        $data['image_path'] = $image;

        Product::create($data);
        return redirect()->route("restaurant.index");
    }



}
