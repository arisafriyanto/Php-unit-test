<?php

namespace Afriyan\Test;

use PHPUnit\Framework\TestCase;

//!13.0 Stub
/*
    Permasalahan Unit Test
    ● Kadang membuat unit test untuk sebuah class bukanlah hal yang mudah, apalagi jika ternyata class
      tersebut tergantung dengan object lain
    ● Apalagi jika ternyata object yang dibutuhkan ternyata tergantung dengan object lain lagi
    ● Hal seperti ini akan sangat menyulitkan saat membuat unit test
    ● Sebagai contoh kita akan coba membuat studi kasus sederhana membuat class yang kompleks
*/

class StubTest extends TestCase
{
  private ProductRepository $repository;
  private ProductService $service;

  protected function setUp(): void
  {
    $this->repository = $this->createStub(ProductRepository::class);
    $this->service = new ProductService($this->repository);
  }

  //!13.1 konfigurasi stub

  public function testStub(): void
  {
    $product = new Product;
    $product->setId("1");

    $this->repository->method("findById")->willReturn($product);

    self::assertSame($product, $this->repository->findById("1"));
  }

  //!13.2 Konﬁgurasi Stub dengan Map

  public function testStubMap(): void
  {
    $product1 = new Product;
    $product1->setId("1");

    $product2 = new Product;
    $product2->setId("2");

    $map = [
      ["1", $product1],
      ["2", $product2]
    ];

    $this->repository->method("findById")->willReturnMap($map);

    self::assertSame($product1, $this->repository->findById("1"));
    self::assertSame($product2, $this->repository->findById("2"));
  }

  //!13.3 Konﬁgurasi Stub dengan Callback

  public function testStubCallback(): void
  {
    $this->repository->method("findById")->willReturnCallback(function (string $id) {
      $product = new Product;
      $product->setId($id);
      return $product;
    });

    self::assertSame("1", $this->repository->findById("1")->getId());
    self::assertSame("2", $this->repository->findById("2")->getId());
  }
}
