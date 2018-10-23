<?php
/**
 * Created by PhpStorm.
 * User: wilder19
 * Date: 10/10/18
 * Time: 15:04
 */

namespace Model;

/**
 * Class Brand
 *
 */
class Brand
{
    private $id;

    private $name;

    private $picture;

    /**
     * @return mixed
     */
    public function getPicture() : string
    {
        return $this->picture;
    }

    /**
     * @param mixed $image
     */
    public function setPicture(string $picture): Brand
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return Brand
     */
    public function setId(int $id): Brand
    {
        $this->id = $id;

        return $this;
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
     *
     * @return Brand
     */
    public function setName(string $name): Brand
    {
        $this->name = $name;

        return $this;

    }

}