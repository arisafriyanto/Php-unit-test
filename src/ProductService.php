<?php

namespace Afriyan\Test;

use Exception;

class ProductService
{
    public function __construct(private ProductRepository $repository)
    {
    }

    public function register(Product $product): Product
    {
        if ($this->repository->findById($product->getId()) != null) {
            throw new Exception("Product is already exist");
        }

        return $this->repository->save($product);
    }

    public function delete(string $id): void
    {
        // dia akan cek apakah ada id di DB nya, kalo gk ada akan error
        $product = $this->repository->findById($id);
        if ($product == null) {
            // $this->repository->delete($product); // jika dia logicnya salah, di mock dia akan gagal karena kita pke never

            throw new Exception("Product is not found");
        }

        $this->repository->delete($product);
    }
}
