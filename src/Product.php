<?php

namespace src;

class Product
{

    private int $count = 0;
    private string $key;

    public function __construct(
        public string $make,
        public string $model,
        public string $colour,
        public string $capacity,
        public string $network,
        public string $grade,
        public string $condition
    ) {
        $this->key = md5("$this->make-$this->model-$this->colour-$this->capacity-$this->network-$this->grade-$this->condition");
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function incrementCount(): void
    {
        $this->count++;
    }

    public function __toString(): string
    {
        return "
                make: $this->make, 
                model: $this->model, 
                colour: $this->colour, 
                capacity: $this->capacity, 
                network: $this->network, 
                grade: $this->grade, 
                condition: $this->condition
                ";
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public static function printList(array $products): void
    {
        foreach ($products as $product) {
            print $product;
        }
    }
}

