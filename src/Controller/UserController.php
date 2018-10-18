<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 18/10/18
 * Time: 08:12
 */

namespace Controller;

use Service\DropdownService;

class UserController extends AbstractController
{
    private $categories;
    private $brands;

    public function __construct()
    {
        parent::__construct();

        $categoryService = new DropdownService();
        $this->categories = $categoryService->getCategories();

        $brandService = new DropdownService();
        $this->brands = $brandService->getBrands();
    }

    public function index()
    {
        return $this->twig->render('Item/index.html.twig', ['categories' => $this->categories, 'brands' => $this->brands]);

    }


}