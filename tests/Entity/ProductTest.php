<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\Product;

class ProductTest extends TestCase
{
    public function testEntity()
    {
        $product = new Product();
        $product->setModel('model test');
        $product->setBrand('brand test');
        $product->setDescription('description test');
        $product->setStock(1);
        $product->setColor('color test');
        $product->setPrice(2);

        $this->assertEquals('model test', $product->getmodel());
        $this->assertEquals('brand test', $product->getBrand());
        $this->assertEquals('description test', $product->getDescription());
        $this->assertEquals(1, $product->getStock());
        $this->assertEquals('color test', $product->getColor());
        $this->assertEquals(2, $product->getPrice());
        $this->assertNull($product->getId());
    }
}
