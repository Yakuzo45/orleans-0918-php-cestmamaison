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

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
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
     * @var int
     */
    private $category_id;

    /**
     * @var int
     */
    private $brand_id;


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
    public function setId(int $id)
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
    public function setName(string $name)
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
    public function setDescription(string $description)
    {
        $this->description = $description;

    }


    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }


    /**
     * @param string $price
     * @return Product
     */
    public function setPrice(string $price)
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
    public function setPicture(string $picture)
    {
        $this->picture = $picture;

    }

    /**
     * @return mixed
     */
    public function getBrandId() :int
    {
        return $this->brand_id;
    }

    /**
     * @param mixed $brand_id
     */
    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    /**
     * @return mixed
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public function setCa(string $trim)
    {
    }

    public function setCate(string $trim)
    {
    }

}
