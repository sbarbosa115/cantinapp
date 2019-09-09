<?php

namespace App\Http\Controllers\Frontend;

use App\DataModels\OrderDataModel;
use App\Facades\OrderService;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\ReOrderRequest;
use App\Model\Order;
use App\Notifications\OrderCreated;
use App\Repository\OrderRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OrderController extends Controller
{

    public function index(): View
    {
        $user = Auth::user();
        $orders = OrderRepository::getOrdersICanSee($user);
        return view('frontend.order.index', [
            'orders' => $orders,
            'restaurant' => $user->restaurant,
        ]);
    }

    public function store(CreateOrderRequest $request): JsonResponse
    {
        $user = Auth::user();
        if (!$user->can('create', Order::class)) {
            return response()->json(['status' => 'Forbidden'], Response::HTTP_FORBIDDEN);
        }

        $orderData = $request->validated();
        $order = OrderService::createOrder(OrderDataModel::createFromRequest($orderData));
        Notification::send($user, new OrderCreated($order, $user));
        return response()->json(['status' => 'ok', 'order' => $order]);
    }

    public function reOrder(ReOrderRequest $request, Order $order): JsonResponse
    {
        $user = Auth::user();
        if (!$user->can('create', Order::class)) {
            return response()->json(['status' => 'Forbidden'], Response::HTTP_FORBIDDEN);
        }
        $orderData = $request->validated();
        $orderDate = Carbon::now()->setTimeFromTimeString($orderData['pickup_at']);

        $order = OrderService::duplicateOrder(
            OrderDataModel::createFromModel($order),
            $orderDate
        );
        Notification::send($user, new OrderCreated($order, $user));

        $request->session()->flash('info', trans('frontend.orders.order_created') . ' ' . $orderData['pickup_at']);
        return response()->json(['status' => 'ok', 'order' => $order]);
    }

}
