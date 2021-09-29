<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaleRequest;
use App\Services\SaleService;

class SaleController extends Controller
{
    private $saleService;

    function __construct(SaleService $saleService )
    {
        $this->saleService = $saleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->saleService->index($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        $request->validated();
        $response = $this->saleService->store($request);
        isset($response['error']) ? $codStatus = 400: $codStatus = 201;
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
        return $this->saleService->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SaleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, $id)
    {
        $request->validated();
        $response = $this->saleService->update($request->request, $id);
        isset($response['error']) ? $codStatus = 400: $codStatus = 201;
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
        $response = $this->saleService->destroy($id);
        isset($response['error']) ? $codStatus = 400: $codStatus = 201;
        return response()->json($response, $codStatus);
    }
}
