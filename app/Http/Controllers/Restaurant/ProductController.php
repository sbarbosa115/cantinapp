<?php

namespace App\Http\Controllers\Restaurant;

use App\Model\Product;
use App\Model\Taxonomy;
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
            'tags' => 'json',
            'category' => 'required'
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
        $data = $request->all();
        $validator = $this->validator($data);

        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $this->uploadImage($data);
        $product = Product::create($data);
        $product->attachTaxonomies($data['tags'], $data['category']);

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
        $data = $request->all();
        $validator = $this->validator($data);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }

        $this->uploadImage($data);
        $product->update($data);
        $product->attachTaxonomies($data['tags'], $data['category']);

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
