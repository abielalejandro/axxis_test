<?php

namespace App\Domain\Service;

interface ProductService {
    function createProducts(array $products);
    function updateProducts(array $products);
    function listProducts();
}