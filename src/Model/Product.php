<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 12/10/18
 * Time: 17:00
 */

namespace Model;

class Product
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $picture;
    /**
     * @var bool
     */
    private $highlightedProduct;

    /**
     * @return bool
     */
    public function isHighlightedProduct(): bool
    {
        return $this->highlightedProduct;
    }

    /**
     * @param bool $highlightedProduct
     */
    public function setHighlightedProduct(bool $highlightedProduct)
    {
        $this->highlightedProduct = $highlightedProduct;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @param int $id
     * @return Product
     */
    public function setId(int $id): Product
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }


    /**
     * @param string $description
     * @return Product
     */
    public function setDescription(string $description): Product
    {
        $this->description = $description;
    }


    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }


    /**
     * @param float $price
     * @return Product
     */
    public function setPrice(float $price): Product
    {
        $this->price = $price;
    }


    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }


    /**
     * @param string $picture
     * @return Product
     */
    public function setPicture(string $picture): Product
    {
        $this->picture = $picture;
    }
}
