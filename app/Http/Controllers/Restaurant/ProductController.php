<?php

namespace App\Http\Controllers\Restaurant;

use App\Model\Product;
use App\Model\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ProductController extends Controller
{

    /**
     * All validation rules before store a entity.
     * @param array $form Form fields.
     * @return mixed
     */
    public function validator(array $form){
        $validator = Validator::make($form, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image',
        ]);

        return $validator;
    }

    /**
     * Show all entities and their options.
     */
    public function index(){
        $products = Product::all();

        return view('restaurant.product.index', ['products' => $products]);
    }

    /**
     * Return the view to store a product.
     */
    public function create(){
        return view('restaurant.product.create', ["product" => new Product()]);
    }


    /**
     * Store validate and store a product in database.
     * @param Request $request User request object.
     * @return Redirect if all is good to controller index otherwise self-redirect with errors.
     */
    public function store(Request $request){
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


    /**
     * Return the view to edit a product.
     * @param $id Database product identifier.
     * @return $this View to edit the product.
     */
    public function edit($id){
        $product = Product::find($id);

        if(!$product){
            abort(404);
        }

        return view('restaurant.product.create', ["product" => $product]);
    }


    /**
     * Validate and store the product.
     * @param Request $request
     * @param $id Database product identifier.
     * @return $this
     */
    public function update(Request $request, $id){
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

    /**
     * Remove product from available products.
     * @param Request $request Request object.
     * @param $id Product id.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id){
        $product = Product::findOrFail($id);

        $product->delete();

        $request->session()->flash('success', 'The action was completed successfully.');
        return redirect()->route("restaurant.product.index");
    }

    public function sides(Product $product){
        $sides = $product->sides()->get();
        dd($sides);
    }
}
