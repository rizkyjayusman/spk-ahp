<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository) 
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct($request)
    {
        return $this->productRepository->create($request);
    }

    public function getProductList()
    {
        return $this->productRepository->getProductList();
    }

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }
}
