<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Requests\RestaurantStoreRequest;
use App\Model\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(): View
    {
        $restaurant = Auth::guard('employee')->user()->restaurant;

        return view('restaurant.account.index', ['restaurant' => $restaurant]);
    }

    public function update(RestaurantStoreRequest $request): View
    {
        /** @var $restaurant Restaurant */
        $restaurant = Auth::guard('employee')->user()->restaurant;
        $validated = $request->validated();

        $restaurant->update($validated);
        $request->session()->flash('success', 'Restaurant data updated successfully.');

        return view('restaurant.account.index', ['restaurant' => $restaurant]);
    }

    public function handleAllowOrderStatus(): RedirectResponse
    {
        $restaurant = Auth::guard('employee')->user()->restaurant;
        $restaurant->allow_orders = !$restaurant->allow_orders;
        $restaurant->save();
        return redirect()->back();
    }

}
