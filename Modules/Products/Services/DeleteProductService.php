<?php

namespace Modules\Products\Services;

use App\Jobs\DeleteProduct;
use Modules\Products\Entities\Product;

class DeleteProductService
{
    private $product;
    private $deleteProductQueue;
    public function __construct(Product $product, DeleteProduct $deleteProductQueue)
    {
        $this->product = $product;
        $this->deleteProductQueue = $deleteProductQueue;
    }

    public function deleteProduct($id){
        $product = $this->product->find($id);

        if(!isset($product)){
            return 'Product Not Found';
        }
        $this->deleteProductQueue->dispatch($product);
        $product->delete();
        return 'Product Deleted Successfully';
    }
}
