<?php

namespace App\Http\Controllers\Restaurant;

use App\Model\Balance;
use App\User;
use Illuminate\Http\Request;

class BalanceController extends Controller
{

    /**
     * Return the index home page.
     */
    public function index(){
        $items = User::all();
        return view('restaurant.balance.index', ['items' => $items]);
    }

    /**
     * Return the view to create a new balance.
     * @param $id User id to assoc the balance.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id){
        $item = new Balance();

        $user = User::findOrFail($id);

        return view('restaurant.balance.create', ['item' => $item, "user" => $user]);
    }

    /**
     * Store a new user balance.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        request()->validate([
            'user_id' => 'required',
            'quantity' => 'required'
        ]);

        $quantity = $request->all()["quantity"];
        $user = User::findOrFail($request->all()["user_id"]);

        for($i = 0; $i < $quantity; $i++){
            Balance::create([
               "user_id" => $user->id,
                "status" => "available"
            ]);
        }

        $request->session()->flash('success', "The user {$user->name} now has a new account balance.");
        return redirect()->route("restaurant.balance.index");
    }
}
