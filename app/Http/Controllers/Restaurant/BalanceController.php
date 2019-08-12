<?php

namespace App\Http\Controllers\Restaurant;

use App\Facades\BalanceService;
use App\Http\Requests\BalanceStoreRequest;
use App\Model\Balance;
use App\Repository\BalanceRepository;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BalanceController extends Controller
{
    public function index(): View
    {
        $items = User::all();

        return view('restaurant.balance.index', ['items' => $items]);
    }

    public function create(User $user): View
    {
        return view('restaurant.balance.create', ['item' => new Balance(), 'user' => $user]);
    }

    public function store(BalanceStoreRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();;
        BalanceService::addUserBalance($user, $data['quantity'], $data['invoice']);
        $request->session()->flash('success', "The user {$user->name} now has a new account balance.");

        return redirect()->route('restaurant.balance.index');
    }

    public function log(User $user): View
    {
        $items = BalanceRepository::getCustomerOrderLog($user);

        return view('restaurant.balance.log', ['items' => $items, 'user' => $user]);
    }
}
