<?php

namespace Modules\Products\Services;

use Modules\Products\Entities\Product;

class ShowProductService
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function showProduct($id){
        $product = $this->product->find($id);
        if(!isset($product)){
            return 'Product Not Found';
        }
        return [
            'name'=>$product->name,
            'price'=>$product->price,
            'stock_quantity'=>$product->stock_quantity,
        ];
    }

}
