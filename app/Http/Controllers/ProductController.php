<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $productService;

    function __construct(ProductService $productService )
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->productService->index($request);    
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request->validated();
        $response = $this->productService->store($request->request);
        isset(json_decode($response)->error) ? $codStatus = 400: $codStatus = 201;
        return response()->json($response, $codStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = $this->productService->show($id);
        isset(json_decode($response)->error) ? $codStatus = 400: $codStatus = 200;
        return response()->json($response, $codStatus);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $response = $this->productService->update($request->request, $id);
        isset(json_decode($response)->error) ? $codStatus = 400: $codStatus = 200;
        return response()->json($response, $codStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->productService->destroy($id);
        isset(json_decode($response)->error) ? $codStatus = 400: $codStatus = 200;
        return response()->json($response, $codStatus);
    }
}
