<?php

namespace Afriyan\Test;

use Exception;
use PHPUnit\Framework\TestCase;

class ProductServiceMockTest extends TestCase
{
    private ProductRepository $repository;
    private ProductService $service;

    //!15.0 Mock object unit test

    protected function setUp(): void
    {
        $this->repository = $this->createMock(ProductRepository::class);
        $this->service = new ProductService($this->repository);
    }

    //!15.1 Test Mock

    public function testMock(): void
    {
        $product = new Product;
        $product->setId("1");

        $this->repository->expects($this->once())->method("findById")->willReturn($product);

        $result = $this->repository->findById("1");

        self::assertSame($product, $result);
    }

    //!15.2 test delete success dengan mock

    public function testDeleteSuccess(): void
    {

        $product = new Product;
        $product->setId("1");

        $this->repository->expects($this->once())->method("delete")->with(self::equalTo($product));

        $this->repository->expects($this->once())
            ->method("findById")->with(self::equalTo($product->getId()))->willReturn($product);

        $this->service->delete("1");

        /**
         *! unit test akan error karena once bisa panggil function hanya satu kali
         *?  $this->service->delete("1");
         */

        self::assertTrue(true, "success delete");
    }

    //!15.2 test delete gagal dengan mock

    public function testDeleteGagal(): void
    {
        $this->repository->expects($this->never())->method("delete");
        $this->expectException(Exception::class);
        $this->repository->method("findById")->with(self::equalTo("1"))->willReturn(null);
        $this->service->delete("1");
    }
}
