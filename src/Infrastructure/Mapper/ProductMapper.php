<?php
namespace App\Infrastructure\Mapper;

use App\Infrastructure\Entity\ProductEntity;
use App\Domain\Model\Product;

class ProductMapper {
    public static function toEntity(Product $product): ProductEntity {
        $entity = new ProductEntity();
        $entity->setId($product->getId());
        $entity->setName($product->getName());
        $entity->setDescription($product->getDescription());
        $entity->setSku($product->getSku());
        $entity->setSku($product->getSku());

        return $entity;
    }

    public static function toPersistentEntity(Product $product, ProductEntity $entity ): ProductEntity {
        $entity->setName($product->getName());
        $entity->setDescription($product->getDescription());

        return $entity;
    }

    public static function toDomain(ProductEntity $entity): Product {
        $product = new Product();
        $product->setId($entity->getId());
        $product->setName($entity->getName());
        $product->setDescription($entity->getDescription());
        $product->setSku($entity->getSku());
        $product->setCreatedAt($entity->getCreatedAt());
        $product->setUpdatedAt($entity->getUpdatedAt());
        $product->setSku($entity->getSku());

        return $product;
    }
}