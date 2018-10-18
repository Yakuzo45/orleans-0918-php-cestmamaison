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
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Product
     */
    public function setId($id): Product
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Product
     */
    public function setName($name): Product
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Product
     */
    public function setDescription($description): Product
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return Product
     */
    public function setPrice($price): Product
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     * @return Product
     */
    public function setPicture($picture): Product
    {
        $this->picture = $picture;
    }
}
