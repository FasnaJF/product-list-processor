<?php

namespace src;

class UniqueProductListFileGenerator
{

    public function createCombinationCSV(array $products, string $outputFile): void
    {
        $data = $this->combineUniqueProducts($products);

        $fp = fopen($outputFile, 'w');
        $header = ['make', 'model', 'colour', 'capacity', 'network', 'grade', 'condition', 'count'];
        fputcsv($fp, $header);

        foreach ($data as $product) {
            $row = [
                'make' => $product->make,
                'model' => $product->model,
                'colour' => $product->colour,
                'capacity' => $product->capacity,
                'network' => $product->network,
                'grade' => $product->grade,
                'condition' => $product->condition,
                'count' => $product->getCount()
            ];
            fputcsv($fp, $row);
        }
        fclose($fp);
    }

    protected function combineUniqueProducts(array $products): array
    {
        $uniqueProducts = [];
        foreach ($products as $product) {
            if (isset($uniqueProducts[$product->getKey()])) {
                $uniqueProducts[$product->getKey()]->incrementCount();
                continue;
            }
            $product->incrementCount();
            $uniqueProducts[$product->getKey()] = $product;
        }
        return $uniqueProducts;
    }
}