<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\OrderService;
use App\Http\Requests\CreateOrderRequest;
use App\Notifications\OrderCreated;
use App\Repository\OrderRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{

    public function index(): View
    {
        $user = Auth::user();
        $orders = OrderRepository::ordersByCustomer($user);
        return view('frontend.order.index', ['orders' => $orders]);
    }

    public function store(CreateOrderRequest $request): Response
    {
        $orderData = $request->validated();
        $order = OrderService::createOrder($orderData);
        Notification::send(\Auth::user(), new OrderCreated($order, \Auth::user()));
        return response()->json(['status' => 'ok', 'order' => $order]);
    }

}
