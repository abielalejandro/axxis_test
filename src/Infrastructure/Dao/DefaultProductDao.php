<?php

namespace App\Infrastructure\Dao;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Domain\Dao\ProductDao;
use App\Domain\Model\Product;
use App\Infrastructure\Entity\ProductEntity;
use App\Infrastructure\Mapper\ProductMapper;
use App\Exception\ProductNotFound;
use App\Exception\ProductFound;

class DefaultProductDao implements ProductDao
{
    private LoggerInterface $logger;
    private EntityManagerInterface $entityManager;
    private $repository;

    public function __construct(
        LoggerInterface $logger, 
        EntityManagerInterface $entityManager) {
        $this->logger = $logger;
        $this->entityManager =$entityManager;
        $this->repository = $entityManager->getRepository(ProductEntity::class);
    }

    public function createProduct(Product $productDomain)
    {
        
        $productPersisted = $this->findBySku($productDomain->getSku());
        if ($productPersisted) {
            $this->logger->info(sprintf('Creating Product sku=%s exists',$productDomain->getSku()));
            throw new ProductFound(sprintf('Product sku=%s exists',$productDomain->getSku()));
        }

        $product = ProductMapper::toEntity($productDomain);

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
    public function updateProduct(Product $productDomain)
    {
        $productPersisted = $this->findBySku($productDomain->getSku());
        if (!$productPersisted) {
            $this->logger->info(sprintf('Updating Product sku=%s does not exists',$productDomain->getSku()));
            throw new ProductNotFound(sprintf('Product sku=%s does not exists',$productDomain->getSku()));
        }

        $productPersisted = ProductMapper::toPersistentEntity($productDomain, $productPersisted);
        $this->entityManager->persist($productPersisted);
        $this->entityManager->flush();
    }

    public function listProducts() {
        $products = array();
        $productsPersisted= $this->repository->findAll();
        foreach($productsPersisted as $productPersisted) {
            $products[] = ProductMapper::toDomain($productPersisted);
        }

        return $products;
    }
    private function findBySku(string $sku) {
        return $this->repository->findOneBy(['sku' => $sku]);
    }
}