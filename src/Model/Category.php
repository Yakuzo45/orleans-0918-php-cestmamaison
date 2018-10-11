<?php


namespace Model;

/**
 * Class Category
 *
 */
class Category
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
     * @return Item
     */
    public function setId($id): Category
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
     * @return Category
     */
    public function setName($name):Category
    {
        $this->name = $name;

        return $this;
    }
}
