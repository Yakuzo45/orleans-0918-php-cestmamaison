<?php



namespace Controller;

use Model\CategoryManager;
use Service\DropdownService;
use Model\ProductManager;

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

    public function productsByOneCategory(int $id)
    {
        $productManager = new ProductManager($this->getPdo());
        $productsAndCategory = $productManager->selectAllProductsByOneCategory($id);
        return $this->twig->render('Visitor/Category/showProductsWithCategory.html.twig',[
            'productAndCategory' => $productsAndCategory,
            'categories' => $this->dropdownService->getCategories(),
            'brands' => $this->dropdownService->getBrands(),
        ]);
    }

    public function productsByOneBrand(int $id)
    {
        $productManager = new ProductManager($this->getPdo());
        $productsAndBrand = $productManager->selectAllProductsByOneBrand($id);
        return $this->twig->render('Visitor/Brand/showProductsWithBrand.html.twig',[
            'productAndBrand' => $productsAndBrand,
            'categories' => $this->dropdownService->getCategories(),
            'brands' => $this->dropdownService->getBrands(),
        ]);
    }

    public function contact()
    {
        return $this->twig->render('Visitor/Contact/index.html.twig');
    }
}


