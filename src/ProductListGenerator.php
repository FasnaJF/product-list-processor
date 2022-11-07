<?php

namespace src;

use Exception;

class ProductListGenerator
{
    /**
     * @throws Exception
     */
    public function createProducts($productDetails): array
    {
        $products = [];
        if (empty($productDetails)) {
            throw new Exception("Your input is empty.");
        }
        foreach ($productDetails as $productDetail) {
            $productDetail = array_values($productDetail);
            $product = new Product(make: $productDetail[0], model: $productDetail[1], colour: $productDetail[5],
                capacity: $productDetail[4], network: $productDetail[6], grade: $productDetail[3],
                condition: $productDetail[2]);
            $products[] = $product;
        }
        return $products;
    }
}