<?php



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
        return $this->twig->render('Visitor/index.html.twig', [
            'categories' => $this->dropdownService->getCategories(),
            'brands' => $this->dropdownService->getBrands(),
        ]);

    }
    public function presentation()
    {
        return $this->twig->render('Visitor/Presentation/index.html.twig',[
            'categories' => $this->dropdownService->getCategories(),
            'brands' => $this->dropdownService->getBrands(),
        ]);
    }


}

