<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Order;
use Validator;

class OrdersController extends Controller
{

    /**
     * Show all entities and their options.
     */
    public function index(){
        $orders = Order::whereIn("status", ["created", "cooking", "delivery"])->get();

        return view('restaurant.orders.index', ['orders' => $orders]);
    }

    /**
     * Return the order detail.
     * @param $id Id of order.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id){
        $order = Order::find($id);
        return view('restaurant.orders.detail', ['order' => $order]);
    }

    /**
     * Return the view to confirm the change of order.
     * @param $id Order unique ID.
     * @param $status The new status to the order.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function change($id, $status){
        $order = Order::find($id);
        return view('restaurant.orders.change', ['order' => $order, 'status' => $status]);
    }

    /**
     * All validation rules before store a entity.
     * @param array $form Form fields.
     * @return mixed
     */
    public function validator(array $form){
        $validator = Validator::make($form, [
            'status' => 'required|in:created,cooking,delivery,archived'
        ]);

        return $validator;
    }

    /**
     * Set the new status for a given order.
     * @param Request $request Laravel object request.
     * @param $id Order Id.
     * @return Redirection if the order was update successfully otherwise abort with 404.
     */
    public function status(Request $request, $id){
        $validator = $this->validator($request->all());

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }

        $order = Order::find($id);
        if(!$order){
            abort(404, "The request orders doesn't exists.");
        }

        $data = $request->all();
        $order->status = $data["status"];
        $order->save();

        $request->session()->flash('success', "The order was changed to {$order->status} successfully.");
        return redirect()->route("restaurant.orders.index");
    }
}
