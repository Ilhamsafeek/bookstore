<?php

namespace Tests\ShoppingCartBundle\Entity;

use PHPUnit\Framework\TestCase;
use ShoppingCartBundle\Entity\Books;
use ShoppingCartBundle\Repository\BooksRepository;

class BookTest extends TestCase
{
    protected $filters;
    protected $object;

    protected function setUp()
    {
        $this->filters['q'] = $Filters ?? false;
        $this->filters['max_price'] = $Filters ?? false;
        $this->filters['min_price'] = $Filters ?? false;
        $this->filters['category'] = $Filters ?? false;

        $this->object = new Books();


    }



    public function testGetterAndSetter() {

        $this->assertNull($this->object->getId());


        $this->object->setName("Test");
        $this->assertEquals("Test", $this->object->getName());

        $this->object->setDescription("description");
        $this->assertEquals("description", $this->object->getDescription());

        $this->object->setPrice(12.32);
        $this->assertEquals(12.32, $this->object->getPrice());

        $this->object->setSoldCount(5);
        $this->assertEquals(5, $this->object->getSoldCount());
    }

}
