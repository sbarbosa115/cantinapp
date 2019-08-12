<?php

namespace App\Services;

use App\Model\Balance;
use App\Model\Order;
use App\Model\Product;
use App\Repository\BalanceRepository;
use App\User;

class BalanceService
{

    private function createBalance(array $balanceData): void
    {
        Balance::create($balanceData);
    }

    private function updatePendingPaidOrder(User $user): void
    {
        foreach ($user->orders(Order::PAYMENT_STATUS_PENDING)->get() as $order) {
            /** @var $balance Balance */
            $shouldThisOrderBeChangedToPaid = true;
            foreach ($order->balances() as $balance) {
                if ($balance === Balance::STATUS_DEBT) {
                    $shouldThisOrderBeChangedToPaid = false;
                }
            }

            if($shouldThisOrderBeChangedToPaid === true) {
                $order->payment_status = Order::PAYMENT_STATUS_PAID;
                $order->save();
            }
        }
    }

    public function addUserBalance(
        User $user,
        int $quantity,
        string $invoice = null
    ): void {
        $debtsBalances = BalanceRepository::getDebtsByUser($user);
        $cont = 0;
        foreach ($debtsBalances as $debtBalance) {
            $debtBalance->status = Balance::STATUS_SPENT;
            $debtBalance->save();
            $cont++;
        }

        $newAvailableBalances = $quantity - $cont;
        for ($i = 0; $i < $newAvailableBalances; ++$i) {
            $this->createBalance([
                'user_id' => $user->id,
                'status' => Balance::STATUS_AVAILABLE,
                'invoice' => $invoice,
            ]);
        }

        $this->updatePendingPaidOrder($user);
    }

    public function syncUserAndBalance(Product $product, Order $order): ?Balance
    {
        $balance = Balance::where('user_id', '=', $order->user->id)
            ->where('status', '=', Balance::STATUS_AVAILABLE)
            ->orderBy('id', 'asc')
            ->first();

        if ($balance instanceof Balance) {
            $balance->product_id = $product->id;
            $balance->order_id = $order->id;
            $balance->status = Balance::STATUS_SPENT;
            $balance->save();
        } else {
            $this->createBalance([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'user_id' => $order->user->id,
                'status' => Balance::STATUS_DEBT,
            ]);
        }
        return $balance;
    }
}
