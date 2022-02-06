<?php

namespace Afriyan\Test;

use Exception;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    private ProductRepository $repository;
    private ProductService $service;

    protected function setUp(): void
    {
        /*  
            createStub() akan membuatkan object dari class/interface ProductRepository
        */

        $this->repository = $this->createStub(ProductRepository::class);


        // akan memanggil class ProductService yang butuh interface ProductRpository
        $this->service = new ProductService($this->repository);
    }

    public function testStub(): void
    {
        $product = new Product;
        $product->setId("1");
        $product->setName("asus");

        // konfigurasi stub supaya return valunya object product
        $this->repository->method("findById")->willReturn($product);

        // dia tidak perduli apapun return value si $result, karena yang dicek tipe data return valuenya
        // dan yang akan dieksekusi $product->setId("1)
        $result = $this->repository->findById("2");

        self::assertSame($product->getId(), $result->getId());

        // jadi ini akan berhasil karena dari object itu akan return id dan name
        self::assertSame($product->getName(), $result->getName());
    }

    public function testStubMap(): void
    {
        // dengan kondisi

        $product1 = new Product;
        $product1->setId("1");

        $product2 = new Product;
        $product2->setId("2");

        // berdasarkan kondisi
        $map = [
            ['1', $product1],
            ['2', $product2],
        ];

        $this->repository->method("findById")->willReturnMap($map);

        // jadi jika ekspetasi kita 1, maka findById harus 1 dan dia akan return $product1
        self::assertSame("1", $this->repository->findById("1")->getId());

        // jadi jika ekspetasi kita 2, maka findById harus 2 dan dia akan return $product2
        self::assertSame("2", $this->repository->findById("2")->getId());
    }

    public function testStubCallback(): void
    {
        $this->repository->method("findById")->willReturnCallback(function (string $id) {
            $product = new Product;
            $product->setId($id);
            $product->setName("aa");

            // harus return value product
            return $product;
        });


        self::assertEquals("1", $this->repository->findById("1")->getId());
        self::assertEquals("2", $this->repository->findById("2")->getId());
        self::assertEquals("3", $this->repository->findById("3")->getId());
        self::assertEquals("aa", $this->repository->findById("aa")->getId());
    }

    /*
        INTEGRASI dgn stub berarti jangan gunakan object asli nya tpi gunakan stub supaya kita bisa ubah perilakunya.
        sehingga jika ada perubahan di classs aslinya tidak ada pengaruh di unit test kita
    */

    public function testRegister(): void
    {
        // jadi findById diset null karena di register kita bikin validasi, datanya harus tidak ada di DB
        $this->repository->method("findById")->willReturn(null);

        // function save ini akan menerima parameter obj Product dan akan return value obj Produk, jadi yang kita terima diparameter kita langsung returnkan saja dan kita return argument ke 0 karena cuma ada satu argument

        // jadi kalo kita lupa konfigurasi stub nya dia tidak akan mengembalikkan nilai, karena defaultnya ketika kita tidak panggil function save dia return stub dan ketika stub dipanggil dia membutuhkan stubnya dan kita tidak konfigurasi maka string $id akan direturn dan akan return string kosong
        $this->repository->method("save")->willReturnArgument(0);

        $product = new Product;
        $product->setId("1");
        $product->setName("asus");

        $result = $this->service->register($product);

        self::assertEquals($product->getId(), $result->getId());
    }

    public function testRegisterFailed(): void
    {
        $this->expectException(Exception::class);

        $productInDB = new Product;
        $productInDB->setId("1");
        $this->repository->method("findById")->willReturn($productInDB);

        $product = new Product;
        $product->setId("1");

        $this->service->register($product);
    }

    /*
        MASALAH PADA STUB

        sangat cocok menggunakan stub jika kita ingin mengetes class yang butuh object lain.
        Namun masalahnya kita tidak tau berapa kali interaksi terjadi terhadap stub
        coba implemensi delete product
    */

    public function testDeleteSuccess(): void
    {
        $product = new Product;
        $product->setId("1");
        $this->repository->method("findById")->willReturn($product);

        $this->service->delete("1");

        /*
            Utk stub yang success kita gunakan assertions
        */
        self::assertTrue(true, "Selesai nich"); // karena return void kita set assertTrue ajah
    }

    public function testDeleteFailed(): void
    {
        /*
            Utk pengecekan yang gagal kita panggil Exceptionnya dan gk perlu assertion, karena jika dai jalankan function findById dan hasilnya null maka dia akan throw exception
        */
        $this->expectException(Exception::class);
        $this->repository->method("findById")->willReturn(null);

        $this->service->delete("1");
    }
}
