<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 18/10/18
 * Time: 09:40
 */

namespace Service;

use Controller\AbstractController;
use Model\CategoryManager;
use Model\BrandManager;

class DropdownService extends AbstractController
{
    public function getCategories()
    {
        $categoryManager = new CategoryManager($this->getPdo());
        $categories = $categoryManager->selectAll();

        return $categories;
    }

    public function getBrands()
    {
        $brandManager = new BrandManager($this->getPdo());
        $brands = $brandManager->selectAll();

        return $brands;
    }
}
