<?php

namespace App\Http\Controllers\Restaurant;

use App\Facades\ProductService;
use App\Http\Requests\ProductStoreRequest;
use App\Model\Product;
use App\Model\Taxonomy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::withoutGlobalScope('available')->get();

        return view('restaurant.product.index', ['products' => $products]);
    }

    public function create(): View
    {
        return view('restaurant.product.create', [
            'product' => new Product(),
            'categories' => Taxonomy\Category::all()
        ]);
    }

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        ProductService::create($data);
        $request->session()->flash('success', 'The action was completed successfully.');

        return redirect()->route('restaurant.product.index');
    }

    public function edit($id): View
    {
        $product = Product::findOrFail($id);
        return view('restaurant.product.create', [
            'product' => $product,
            'categories' => Taxonomy\Category::all()
        ]);
    }

    public function update(ProductStoreRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        ProductService::update($data, $product);
        $request->session()->flash('success', 'The action was completed successfully.');

        return redirect()->route('restaurant.product.index');
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        ProductService::remove($product);
        $request->session()->flash('success', 'The action was completed successfully.');

        return redirect()->route('restaurant.product.index');
    }

    public function changeStatus(Request $request, string $state, int $product): RedirectResponse
    {
        $product = Product::withoutGlobalScope('available')->find($product);

        $product->status = $state;
        $product->save();
        $request->session()->flash('success', "Status changed successfully to {$product->name}");

        return redirect()->route('restaurant.product.index');
    }
}
