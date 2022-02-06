<?php

namespace Afriyan\Test;

use Exception;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertSame;

class ProductServiceTest extends TestCase
{
    private ProductRepository $repository;
    private ProductService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createStub(ProductRepository::class);
        $this->service = new ProductService($this->repository);
    }

    //!14.0 test register sukses

    public function testRegister(): void
    {
        $this->repository->method("findById")->willReturn(null);

        $this->repository->method("save")->willReturnArgument(0);

        $product = new Product;
        $product->setId("1");
        $product->setName("Vivo");

        $result = $this->service->register($product);

        self::assertSame($product->getId(), $result->getId());
    }

    //!14.1 test register gagal

    public function testRegisterGagal(): void
    {
        $this->expectException(Exception::class);

        $productInDB = new Product;
        $productInDB->setId("1");

        $this->repository->method("findById")->willReturn($productInDB);

        $product = new Product;
        $product->setId("1");

        $this->service->register($product);
    }

    //!14.2 test delete sukses

    public function testDeleteSuccess(): void
    {
        $product = new Product;
        $product->setId("1");

        $this->repository->method("findById")->willReturn($product);
        $this->service->delete("1");

        self::assertTrue(true, "delete success");
    }

    //!14.2 test delete gagal

    public function testDeleteGagal(): void
    {
        $this->expectException(Exception::class);
        $this->repository->method("findById")->willReturn(null);

        $this->service->delete("1");
    }
}
