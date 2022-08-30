<?php

namespace Modules\Products\Services;

use App\Jobs\CreateProduct;
use App\Jobs\OutOfStockProduct;
use Modules\Products\Entities\Product;

class StoreProductService
{
    private $product;
    private $createProductQueue;
    private $outOfStockProductQueue;

    public function __construct(Product $product,CreateProduct $createProductQueue, OutOfStockProduct $outOfStockProductQueue)
    {
        $this->product = $product;
        $this->createProductQueue = $createProductQueue;
        $this->outOfStockProductQueue = $outOfStockProductQueue;
    }

    public function storeProduct($data)
    {
       $product =  $this->product->create([
            'name'=>$data['name'],
            'price'=>$data['price'],
            'stock_quantity'=>$data['stock_quantity'],
        ]);

       $this->createProductQueue->dispatch($product);
        if($product->stock_quantity == 0){
            $this->outOfStockProductQueue->dispatch($product);
        }

       return [
           'name'=>$product->name,
           'price'=>$product->price,
           'stock_quantity'=>$product->stock_quantity,
       ];

    }
}
