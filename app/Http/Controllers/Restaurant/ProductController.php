<?php

namespace App\Http\Controllers\Restaurant;

use App\Model\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
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

    public function index(): View
    {
        $products = Product::all();
        return view('restaurant.product.index', ['products' => $products]);
    }

    public function create(): View
    {
        return view('restaurant.product.create', ["product" => new Product()]);
    }

    public function store(Request $request): RedirectResponse
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

    public function edit($id): View
    {
        $product = Product::find($id);
        if(!$product){
            abort(404);
        }
        return view('restaurant.product.create', ["product" => $product]);
    }

    public function update(Request $request, int $id): RedirectResponse
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


    public function destroy(Request $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();
        $request->session()->flash('success', 'The action was completed successfully.');
        return redirect()->route("restaurant.product.index");
    }

}
