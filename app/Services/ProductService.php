<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService 
{

    private $productRepositoriy;

    public function __construct(ProductRepository $productRepositoriy)
    {
        $this->productRepositoriy = $productRepositoriy;
    }

    public function index($request)
    {
        if(isset($request->product_name))
            $query = strtoupper($request->product_name);
            return $this->productRepositoriy->getByNameOrReference($query);
        
        return $this->productRepositoriy->getAll();
    }

    public function store($request){
        return $this->productRepositoriy->store($request);
    }

    public function show($id)
    {
        return $this->productRepositoriy->show($id);
    }

    public function update($request, $id){
        return $this->productRepositoriy->update($request, $id);
    }

    public function destroy($id){
        return $this->productRepositoriy->destroy($id);
    }
    
}