<?php


namespace App\DataModels;


class ProductDataModel
{

    /**
     * @var int
     */
    public $product_id;

    /**
     * @var int[]
     */
    public $sides;

    /**
     * @var int[]
     */
    public $beverages;

    /**
     * @var string
     */
    public $comment;

    public static function createFromRequest(array $productData): self
    {
        $productDataModel = new self;
        $productDataModel->product_id = $productData['product_id'];
        $productDataModel->sides = $productData['sides'];
        $productDataModel->beverages = $productData['beverages'];
        $productDataModel->comment = $productData['comment'];
        return $productDataModel;
    }

}
