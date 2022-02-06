<?php

namespace Afriyan\Test;

use Exception;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\once;

class ProductServiceMockTest extends TestCase
{
    private ProductRepository $repository;
    private ProductService $service;

    protected function setUp(): void
    {
        /*  createStub() akan membuatkan object dari class/interface ProductRepository
            $this->repository = $this->createStub(ProductRepository::class);

            jadi disini kita ubah ke  createMock karena kita butuh tau berapa kali interaksi yang terjadi di method yang ada di dalam mock objectnya
        */

        $this->repository = $this->createMock(ProductRepository::class);

        // akan memanggil class ProductService yang butuh interface ProductRpository
        $this->service = new ProductService($this->repository);
    }

    public function testMock(): void
    {
        $product = new Product;
        $product->setId("1");
        $this->repository->expects($this->once())->method("findById")->willReturn($product);

        $result = $this->repository->findById("1");

        /*
            Jika method dijalankan lagi akan error karena kita gunakan expects(self::once())->method('findById')
            dan findById harus dipanggil 1 kali di function unit testnya

            $result = $this->repository->findById("2");
        */

        self::assertSame($product, $result);
    }

    public function testDeleteSuccess(): void
    {
        /* 
            jadi kita hanya akan menerima function delete hanya 1 kali ajah, tidak boleh lebih dan kurang, ini akan error jika di service mengirim function delete yg ada di repository 2 kali, ini akna sukses jika pke stub
            tidak butuh return karena function delete tidak return apapun 
        */

        $product = new Product;
        $product->setId("1");

        $this->repository->expects(self::once())->method("delete")->with(self::equalTo($product));

        $this->repository->expects($this->once())->method("findById")->with(self::equalTo($product->getId()))->willReturn($product);

        $this->service->delete("1");
        self::assertTrue(true, "success delete");
    }

    public function testDeleteFailed(): void
    {
        /** jadi jika function delete yang di repository tidak pernah dipanggil dia akan throw error */
        $this->repository->expects($this->never())->method("delete");

        $this->repository->expects($this->once())->method("findById")->with(self::equalTo("1"))->willReturn(null);

        $this->expectException(Exception::class);
        $this->service->delete("1");
    }
}
