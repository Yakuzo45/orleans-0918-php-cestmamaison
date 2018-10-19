<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 18/10/18
 * Time: 08:12
 */

namespace Controller;

use Service\DropdownService;

class HomeController extends AbstractController
{
    private $dropdownService;

    public function __construct()
    {
        parent::__construct();

        $this->dropdownService = new DropdownService();
    }

    public function index()
    {
        return $this->twig->render('Visitor/index.html.twig', ['categories' => $this->dropdownService->getCategories(), 'brands' => $this->dropdownService->getBrands()]);

    }


}