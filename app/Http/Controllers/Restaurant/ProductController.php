<?php

namespace App\Http\Controllers\Restaurant;

use App\Model\Product;
use App\Model\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ProductController extends Controller
{

    public function validator(array $form)
    {
        $validator = Validator::make($form, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image',
        ]);
        return $validator;
    }

    public function index()
    {
        $products = Product::all();
        return view('restaurant.product.index', ['products' => $products]);
    }

    public function create()
    {
        return view('restaurant.product.create', ["product" => new Product()]);
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $image = $this->uploadImage($request);
        $data = $request->all();
        $data['image_path'] = $image;

        Product::create($data);
        $request->session()->flash('success', 'The action was completed successfully.');

        return redirect()->route("restaurant.product.index");
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if(!$product){
            abort(404);
        }
        return view('restaurant.product.create', ["product" => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validator = $this->validator($request->all());
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $this->uploadImage($request);
        $product->update($request->all());
        $request->session()->flash('success', 'The action was completed successfully.');
        return redirect()->route("restaurant.product.index");
    }


    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        $request->session()->flash('success', 'The action was completed successfully.');
        return redirect()->route("restaurant.product.index");
    }

    public function sides(Product $product)
    {
        $sides = $product->sides()->get();
        dd($sides);
    }
}
