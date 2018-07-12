<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Model\Order;
use App\Services\Orders;
use Validator;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Order::whereNotIn("status", ["archived"])->orderBy("pickup_at", "desc")->get();
        return view('restaurant.orders.index', ['orders' => $orders]);
    }

    public function detail($id)
    {
        $order = Order::find($id);
        return view('restaurant.orders.detail', ['order' => $order]);
    }

    public function change($id, $status)
    {
        $order = Order::find($id);
        return view('restaurant.orders.change', ['order' => $order, 'status' => $status]);
    }

    public function validator(array $form)
    {
        $validator = Validator::make($form, [
            'status' => 'required|in:created,cooking,cooked,delivered,archived'
        ]);
        return $validator;
    }

    public function status(Request $request, $id)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $order = Order::findOrFail($id);
        $data = $request->all();
        $order->status = $data["status"];
        $order->save();
        $request->session()->flash('success', "The order was changed to {$order->status} successfully.");
        return redirect()->route("restaurant.orders.index");
    }
}
