<?php

namespace Afriyan\Test;

interface ProductRepository
{
    public function save(Product $product): Product;

    public function delete(?Product $product): void;

    public function findById(string $id): ?Product;

    public function findAll(): array;
}
