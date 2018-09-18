<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Requests\ProductStoreRequest;
use App\Model\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Validator;

class ProductController extends Controller
{

    public function index(): View
    {
        $products = Product::all();
        return view('restaurant.product.index', ['products' => $products]);
    }

    public function create(): View
    {
        return view('restaurant.product.create', ["product" => new Product()]);
    }

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
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

    public function update(ProductStoreRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
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
