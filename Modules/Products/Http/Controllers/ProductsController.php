<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Products\Http\Requests\ProductRequest;
use Modules\Products\Services\DeleteProductService;
use Modules\Products\Services\ShowProductService;
use Modules\Products\Services\StoreProductService;
use Modules\Products\Services\UpdateProductService;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('products::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('products::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request,StoreProductService $service)
    {
            $product = $service->storeProduct($request->all());
            return response()->json(['status'=>'success','data'=>$product]);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return JsonResponse
     */
    public function show($id,ShowProductService $service)
    {
            $product = $service->showProduct($id);
        return response()->json(['status'=>'success','data'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('products::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param ProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ProductRequest $request, $id, UpdateProductService $service)
    {


        $product = $service->updateProduct($id,$request->all());
        return response()->json(['status'=>'success','data'=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id ,DeleteProductService $service)
    {
       $product =  $service->deleteProduct($id);
        return response()->json(['status'=>'success','data'=>$product]);

    }
}
