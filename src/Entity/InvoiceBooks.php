<?php

namespace ShoppingCartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceBooks
 *
 * @ORM\Table(name="invoice_books")
 * @ORM\Entity(repositoryClass="ShoppingCartBundle\Repository\InvoiceBooksRepository")
 */
class InvoiceBooks
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Books")
     * @ORM\JoinColumn(name="books", referencedColumnName="id")
     *
     */
    private $book;


    /**
     * @ORM\ManyToOne(targetEntity="Invoice")
     * @ORM\JoinColumn(name="invoice", referencedColumnName="id")
     */

    private $invoice;

    /**
     * @var int
     *
     * @ORM\Column(name="qty", type="integer")
     */
    private $qty;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set book.
     *
     * @param int $book
     *
     * @return InvoiceBooks
     */
    public function setBook($book)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book.
     *
     * @return int
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set qty.
     *
     * @param int $qty
     *
     * @return InvoiceBooks
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get qty.
     *
     * @return int
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set price.
     *
     * @param float $price
     *
     * @return InvoiceBooks
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}
