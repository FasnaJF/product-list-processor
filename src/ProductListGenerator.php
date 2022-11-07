<?php

namespace src;

use src\exceptions\ParserException;

class ProductListGenerator
{
    /**
     * @throws ParserException
     */
    public function createProducts(array $productDetails): array
    {
        $products = [];
        if (empty($productDetails)) {
            throw ParserException::emptyInput();
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