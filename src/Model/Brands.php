<?php
/**
 * Created by PhpStorm.
 * User: wilder19
 * Date: 10/10/18
 * Time: 15:04
 */

namespace Model;

/**
 * Class Brands
 *
 */
class Brands
{
    private $id;

    private $name;

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
     * @return Brands
     */
    public function setId($id): Brands
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
     * @return Brands
     */
    public function setName($name): Brands
    {
        $this->name = $name;

        return $this;

    }

}