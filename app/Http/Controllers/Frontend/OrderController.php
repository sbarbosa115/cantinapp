<?php

namespace App\Http\Controllers\Frontend;

use App\Product;
use App\User;
use App\Utils\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer',
            'product_id' => 'required|integer'
        ]);

        $product = Product::findOrFail($request->get('product_id'));

        if($validator->fails()) {
            $request->session()->flash('error', "An error occurred trying to process your order, please try again.");
            return view("frontend.order.add", ["product" => $product])->withErrors($validator->errors());
        }

        (new Orders())->addProductToOrder($request, $product, $request->get('quantity'));

        $request->session()->flash('success', 'Item added successfully.');
        return view("frontend.order.add", ["product" => $product]);
    }

    /**
     * Show the current order and their products.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request){
        $orderDetail = (new Orders())->totalOrder($request);

        if($orderDetail["total"] > 0){
            return view("frontend.order.show", ["orderDetail" => $orderDetail]);
        }

        $request->session()->flash('error', "You need to add products before confirm the order.");
        return redirect()->route("frontend.home.index");
    }


    /**
     * Show the view to confirm the pick-up order time.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmTime(){
        return view("frontend.order.confirm");
    }

    /**
     * Return all products in JSON format
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function products(Request $request){
        $products = $request->session()->get("order");

        if($products){
            $products->toArray();
        } else {
            $products = [];
        }

        return response()->json($products);
    }


    /**
     * Store a order in database.
     * @param Request $request
     * @return $this
     */
    public function store(Request $request){
        $now = Carbon::now()->addMinutes(15);
        $validator = Validator::make($request->all(), [
            //'pickup_at' => 'required|date_format:Y-m-d H:i:s|after:'.$now->toDateTimeString(),
            'pickup_at' => 'required|date_format:Y-m-d H:i:s',
            'payment_method' => 'required',
        ]);

        if($validator->fails()) {
            $request->session()->flash('error', "An error occurred trying to process your order, please try again.");
            return redirect()->route("frontend.home.index")->withErrors($validator->errors());
        }

        $products = $request->session()->pull('order');
        (new Orders())->createOrder($products, $request->all());

        $pickUpTime = Carbon::createFromFormat("Y-m-d H:i:s", $request->get("pickup_at"));
        $request->session()->flash('success', "Your order will be ready to pick up in {$pickUpTime->diffForHumans()}");
        return redirect()->route("frontend.home.index");
    }


    /**
     * This method determines if the user has the enough balance to complete the order.
     * @param $id User ID.
     * @return \Illuminate\Http\JsonResponse Result true if the user has enough balance false otherwise.
     */
    public function checkBalance($id){
        $user = User::find($id);
        $result = true;

        $quantity = (new Orders())->totalOrderProducts(Session::get('order'));

        if($user->balances()->count() < $quantity) {
            $result = false;
        }

        return response()->json(["result" => $result]);
    }

}
