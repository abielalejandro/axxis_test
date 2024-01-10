<?php
namespace App\Application\Mapper;

use App\Application\Dto\Response\ProductsResponse;
use App\Domain\Model\Product;

class ProductMapper {
    public static function toProductsResponse(array $products) {
        return new ProductsResponse(
            $products
        );
    }

    public static function toProductsDomain(array $body) {
        $products = array();
        foreach($body as $item) {
            $product = new Product();
            $product->setId(isset($item["id"])? $item["id"]: null);
            $product->setSku($item["sku"]);
            $product->setName($item["name"]);
            $product->setDescription($item["description"]);
            $products[] = $product;
        }

        return $products;
    }

}