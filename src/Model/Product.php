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
    private $category_id;
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
    public function setId(int $id): Product
    {
        $this->id = $id;
        return $this;
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
        return $this;
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
        return $this;
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
    public function setPrice(string $price): Product
    {
        $this->price = $price;
        return $this;
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
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBrandId()
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
    public function getCategoryId()
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
