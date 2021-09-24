<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getByNameOrReference($query)
    {
        return $this->product->where('name','LIKE','%'.$query.'%')
            ->orWhere('reference','LIKE','%'.$query.'%')->get();
    }

    public function getAll()
    {
        return $this->product->all();
    }
    
}