<?php

namespace Modules\Products\Services;

use App\Jobs\OutOfStockProduct;
use App\Jobs\UpdateProduct;
use Modules\Products\Entities\Product;

class UpdateProductService
{
    private $product;
    private $updateProductQueue;
    private $outOfStockProductQueue;
    public function __construct(Product $product,UpdateProduct $updateProductQueue, OutOfStockProduct $outOfStockProductQueue)
    {
        $this->product = $product;
        $this->updateProductQueue = $updateProductQueue;
        $this->outOfStockProductQueue = $outOfStockProductQueue;

    }

    public function updateProduct($id,$data)
    {
        $product = $this->product->find($id);
        if(!isset($product)){
            return 'Product Not Found';
        }
        $product->update([
            'name'=>$data['name'],
            'price'=>$data['price'],
            'stock_quantity'=>$data['stock_quantity'],
        ]);
        $this->updateProductQueue->dispatch($product);
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
