<?php


namespace App\DataModels;


use App\Model\Order;
use App\Model\Product\Beverage;
use App\Model\Side;
use App\OrderProduct;

class OrderDataModel
{

    /**
     * @var string
     */
    public $pickup_at;

    /**
     * @var ProductDataModel[]
     */
    public $products;


    public static function createFromRequest(array $orderData): self
    {
        $orderModelData = new self();
        $orderModelData->pickup_at = $orderData['pickup_at'];

        foreach ($orderData['products'] as $product) {
            $orderModelData->products[] = ProductDataModel::createFromRequest($product);
        }

        return $orderModelData;
    }

    public static function createFromModel(Order $order): self
    {
        $productDataModel = new self;
        $productDataModel->pickup_at = $order->pickup_at->format('H:s');
        foreach ($order->productsOrder()->get() as $product) {

            $meals = $product->sides()->get()->filter(static function(Side $side) {
                return $side->product->type === \App\Model\Product\Side::TYPE_SIDE;
            })->map(static function(Side $side){
                return $side->product->id;
            })->toArray();

            $beverage = $product->sides()->get()->filter(static function(Side $side) {
                return $side->product->type === Beverage::TYPE_BEVERAGE;
            })->map(static function(Side $side){
                return $side->product->id;
            })->toArray();

            /** @var $product \App\Model\OrderProduct */
            $productDataModel->products[] = ProductDataModel::createFromRequest([
                'product_id' => $product->id,
                'sides' => $meals,
                'beverages' => $beverage,
                'comment' => $product->comment,
            ]);
        }

        return $productDataModel;
    }

}
