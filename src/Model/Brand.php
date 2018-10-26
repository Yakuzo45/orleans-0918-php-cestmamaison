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
    private $picture;

    /**
     * @var bool
     */
    private  $highlightedBrand;



    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
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
     */
    public function setName(string $name)
    {
        $this->name = $name;
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
     */
    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return bool
     */
    public function isHighlightedBrand(): bool
    {
        return $this->highlightedBrand;
    }

    /**
     * @param bool $highlightedBrand
     */
    public function setHighlightedBrand(bool $highlightedBrand)
    {
        $this->highlightedBrand = $highlightedBrand;
    }


}