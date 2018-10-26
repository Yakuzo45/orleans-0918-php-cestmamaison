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

    private $highlightedBrand;

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }


    /**
     * @return mixed
     */
    public function getHighlightedBrand()
    {
        return $this->highlightedBrand;
    }

    /**
     * @param mixed $highlightedBrand
     */
    public function setHighlightedBrand($highlightedBrand)
    {
        $this->highlightedBrand = $highlightedBrand;
    }

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