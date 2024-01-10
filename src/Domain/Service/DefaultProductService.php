<?php

namespace App\Domain\Service;

use Psr\Log\LoggerInterface;
use App\Domain\Dao\ProductDao;
use App\Domain\Model\Product;

class DefaultProductService implements ProductService
{
    private LoggerInterface $logger;
    private ProductDao $dao;

    public function __construct(LoggerInterface $logger, ProductDao $dao) {
        $this->logger = $logger;
        $this->dao = $dao;
    }

    public function createProducts(array $products)
    {
        $this->logger->info('Creating products');
        if (!is_array($products) || count($products) === 0 ) {
            throw new \InvalidArgumentException("Product list is required");
        }

        foreach($products as $product) {
            $this->createProduct($product);
        }
    }
    public function updateProducts(array $products)
    {
        $this->logger->info('Updating products');
        if (!is_array($products) || count($products) === 0 ) {
            throw new \InvalidArgumentException("Product list is required");
        }

        foreach($products as $product) {
            $this->updateProduct($product);
        }
    }

    public function listProducts(): array {
        return $this->dao->listProducts();
    }
    private function createProduct(Product $product)
    {
        $this->dao->createProduct($product);
    }
    private function updateProduct(Product $product)
    {
        $this->dao->updateProduct($product);
    }
}