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
    
}