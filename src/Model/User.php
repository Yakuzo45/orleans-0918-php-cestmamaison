<?php
/**
 * Created by PhpStorm.
 * User: billyvivant
 * Date: 17/10/18
 * Time: 10:59
 */

namespace Model;


class User
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $image;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}