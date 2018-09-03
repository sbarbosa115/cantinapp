<?php

namespace App\Http\Controllers\Restaurant;

use App\Model\Balance;
use App\Facades\BalanceService;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BalanceController extends Controller
{

    public function index(): View
    {
        $items = User::all();
        return view('restaurant.balance.index', ['items' => $items]);
    }

    public function create($id): View
    {
        $item = new Balance();
        $user = User::findOrFail($id);
        return view('restaurant.balance.create', ['item' => $item, "user" => $user]);
    }

    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'user_id' => 'required',
            'quantity' => 'required'
        ]);

        $quantity = $request->all()["quantity"];
        $user = User::findOrFail($request->all()["user_id"]);
        BalanceService::addUserBalance($user, $quantity);
        $request->session()->flash('success', "The user {$user->name} now has a new account balance.");
        return redirect()->route("restaurant.balance.index");
    }

    public function log($id): View
    {
        $items = Balance::where("user_id", "=", $id)->where("status", "=", "spent")->orderBy("id", "asc")->get();
        $user = User::find($id);
        return view("restaurant.balance.log", ["items" => $items, "user" => $user]);
    }
}
