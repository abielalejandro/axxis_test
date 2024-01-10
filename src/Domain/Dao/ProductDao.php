<?php

namespace App\Domain\Dao;
use App\Domain\Model\Product;

interface ProductDao {
    function createProduct(Product $product);
    function updateProduct(Product $product);
    function listProducts();
}