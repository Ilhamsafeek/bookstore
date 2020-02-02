<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BooksRepository")
 */
class Books
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="text")
     */
    private $category;

    public function getCategory()
    {
        return $this->category;
    }

        /**
     * @ORM\Column(type="text")
     */
    private $title;

    public function getTitle()
    {
        return $this->title;
    }

           /**
     * @ORM\Column(type="integer")
     */
    private $price;

    public function getPrice()
    {
        return $this->price;
    }

               /**
     * @ORM\Column(type="text")
     */
    private $image;

    public function getImage()
    {
        return $this->image;
    }

}
