<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Requests\OrderStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Services\Orders;
use Illuminate\View\View;
use Validator;

class OrdersController extends Controller
{

    public function index(): View
    {
        $orders = Order::whereNotIn('status', ['archived'])->orderBy('pickup_at', 'desc')->get();
        return view('restaurant.orders.index', ['orders' => $orders]);
    }

    public function detail($id): View
    {
        $order = Order::find($id);
        return view('restaurant.orders.detail', ['order' => $order]);
    }

    public function change($id, $status): View
    {
        $order = Order::find($id);
        return view('restaurant.orders.change', ['order' => $order, 'status' => $status]);
    }

    public function status(OrderStoreRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        $order = Order::findOrFail($id);
        $order->status = $data['status'];
        $order->save();
        $request->session()->flash('success', "The order was changed to {$order->status} successfully.");
        return redirect()->route('restaurant.orders.index');
    }
}
