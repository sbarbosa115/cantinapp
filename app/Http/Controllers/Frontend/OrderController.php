<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\OrderService;
use App\Model\Product;
use App\Notifications\OrderCreated;
use App\Rules\GreaterThanNow;
use App\Rules\MaxOrderDate;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    protected function rules(): array
    {
        return [
            'pickup_at' => [
                'required', 'date_format:Y-m-d H:i:s', new GreaterThanNow(), new MaxOrderDate(),
            ],
            'payment_method' => 'required',
        ];
    }

    public function product($id): View
    {
        $product = Product::findOrFail($id);

        return view('frontend.order.add', ['product' => $product]);
    }

    public function addProduct(Request $request): View
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'quantity' => 'required|integer',
            'product_id' => 'required|integer',
            'side.*' => 'required',
        ]);
        $product = Product::findOrFail($request->get('product_id'));
        if ($validator->fails()) {
            $request->session()->flash('error', 'An error occurred trying to process your order, please try again.');

            return view('frontend.order.add', ['product' => $product])->withErrors($validator->errors());
        }
        OrderService::addProductToCurrentOrder($data, $product);
        $request->session()->flash('success', 'Item added successfully.');

        return view('frontend.order.add', ['product' => $product]);
    }

    public function show(Request $request)
    {
        /** @var $order Collection * */
        $order = OrderService::getCurrentSessionOrder();
        if (Auth::user()) {
            if ($order->count() > 0) {
                return view('frontend.order.show', ['order' => $order]);
            }
            $request->session()->flash('error', 'You need to add products before confirm the order.');
        } else {
            $request->session()->flash('error', 'You need to sign-in before see your the order page.');
        }

        return redirect()->route('frontend.home.index');
    }

    public function confirmTime(): View
    {
        return view('frontend.order.confirm');
    }

    public function products(Request $request): Response
    {
        $products = $request->session()->get('order');
        if ($products) {
            $products->toArray();
        } else {
            $products = [];
        }

        return response()->json($products);
    }

    public function store(Request $request): Response
    {
        $data = $request->all();
        $validator = Validator::make($data, $this->rules());

        if ($validator->fails()) {
            $request->session()->flash('error', 'An error occurred trying to process your order, please try again.');

            return response()->json([
                'redirect' => route('frontend.home.index'),
                'errors' => $validator->errors(),
            ]);
        }

        $order = OrderService::createOrder($data);

        Notification::send(\Auth::user(), new OrderCreated($order, \Auth::user()));

        $pickUpTime = Carbon::createFromFormat('Y-m-d H:i:s', $request->get('pickup_at'));
        $request->session()->flash('success', "Your order will be ready to pick up in {$pickUpTime->diffForHumans()}");

        return response()->json(['redirect' => route('frontend.home.index')]);
    }

    public function checkBalance(): Response
    {
        /** @var $user User */
        $user = Auth::user();
        $result = true;
        $quantity = OrderService::totalOrderProducts();
        if ($user->balances()->count() < $quantity) {
            $result = false;
        }

        return response()->json(['result' => $result]);
    }
}
