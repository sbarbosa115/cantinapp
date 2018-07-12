<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\OrderService;
use App\Model\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Validator;

class OrderController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['product', 'addProduct', 'getProducts', 'products']);
    }

    public function product($id)
    {
        $product = Product::findOrFail($id);
        return view("frontend.order.add", ["product" => $product]);
    }

    public function addProduct(Request $request): View
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'quantity' => 'required|integer',
            'product_id' => 'required|integer',
            'side.*' => 'required'
        ]);
        $product = Product::findOrFail($request->get('product_id'));
        if($validator->fails()) {
            $request->session()->flash('error', "An error occurred trying to process your order, please try again.");
            return view("frontend.order.add", ["product" => $product])->withErrors($validator->errors());
        }
        OrderService::addProductToCurrentOrder($data, $product);

        $request->session()->flash('success', 'Item added successfully.');
        return view("frontend.order.add", ["product" => $product]);
    }

    public function show(Request $request)
    {
        $orderDetail = OrderService::totalOrder();

        if($orderDetail["total"] > 0){
            return view("frontend.order.show", ["orderDetail" => $orderDetail]);
        }

        $request->session()->flash('error', "You need to add products before confirm the order.");
        return redirect()->route("frontend.home.index");
    }

    public function confirmTime(){
        return view("frontend.order.confirm");
    }

    public function products(Request $request)
    {
        $products = $request->session()->get("order");
        if($products){
            $products->toArray();
        } else {
            $products = [];
        }
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'pickup_at' => 'required|date_format:Y-m-d H:i:s',
            'payment_method' => 'required',
        ]);

        if($validator->fails()) {
            $request->session()->flash('error', "An error occurred trying to process your order, please try again.");
            return redirect()->route("frontend.home.index")->withErrors($validator->errors());
        }

        OrderService::createOrder($data);
        $pickUpTime = Carbon::createFromFormat("Y-m-d H:i:s", $request->get("pickup_at"));
        $request->session()->flash('success', "Your order will be ready to pick up in {$pickUpTime->diffForHumans()}");
        return redirect()->route("frontend.home.index");
    }

    public function checkBalance($id)
    {
        $user = User::find($id);
        $result = true;
        $quantity = OrderService::totalOrderProducts();
        if($user->balances()->count() < $quantity) {
            $result = false;
        }
        return response()->json(["result" => $result]);
    }

}
