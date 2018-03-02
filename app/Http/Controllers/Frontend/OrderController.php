<?php

namespace App\Http\Controllers\Frontend;

use App\Product;
use App\Utils\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['product', 'addProduct', 'getProducts', 'create']);
    }

    /**
     * Create view to add products to order.
     * @param $id Product id.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function product($id){
        $product = Product::findOrFail($id);
        return view("frontend.order.add", ["product" => $product]);
    }

    /**
     * Add products to order.
     */
    public function addProduct(Request $request){
        request()->validate([
            'quantity' => 'required|integer',
            'product_id' => 'required|integer',

        ]);

        $product = Product::findOrFail($request->get('product_id'));

        (new Orders())->addProductToOrder($request, $product, $request->get('quantity'));

        $request->session()->flash('status', 'Item added successfully.');
        return view("frontend.order.add", ["product" => $product]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request){
        $orderDetail = (new Orders())->totalOrder($request);
        return view("frontend.order.create", ["orderDetail" => $orderDetail]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmTime(Request $request){
        return view("frontend.order.confirm");
    }


    /**
     * @param Request $request
     */
    public function store(Request $request){

    }

}
