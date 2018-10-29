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
        $productsAndCategory = $productManager->selectAllProducts($id);
        return $this->twig->render('Visitor/Category/showProductsWithCategory.html.twig',[
            'productAndCategory' => $productsAndCategory,
            'categories' => $this->dropdownService->getCategories(),
            'brands' => $this->dropdownService->getBrands(),
        ]);
    }

    public function contact()
    {
        return $this->twig->render('Visitor/Contact/index.html.twig');
    }

    private function checkErrors(array $cleanPost)
    {
        $errorsForm=[];
        if (empty($_post['firstName'])) {
            $errorsForm['firstName'] = "Indiquer votre Prénom";
        } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['firstName'])) {
            $errorsForm['firstName'] = "Votre prénom ne doit pas contenir des caractères spéciaux";
        }
        if (empty($_post['lastName'])) {
            $errorsForm['lastName'] = "Indiquer votre Nom";
        } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['lastName'])) {
            $errorsForm['lastName'] = "Votre nom ne doit pas contenir des caractères spéciaux";
        }
        if (empty($_post['msg'])) {
            $errorsForm['msg'] = "Indiquer votre Message";
        } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['msg'])) {
            $errorsForm['lastName'] = "Votre message ne doit pas contenir des caractères spéciaux";
        }
        if (empty($_post['email'])) {
            $errorsForm['email'] = "Indiquer votre Mail";
        } elseif (!preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{,}$/", $_POST['lastName'])) {
            $errorsForm['email'] = "Votre mail  doit être correctement en format email";
        }
        return $errorsForm;
    }

    /**
     * @return array
     */
    public function validContactForm() :array
    {
        $errorsForm = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST as $key => $value){
                $cleanPost[$key]=trim($value);
            }
            $errorsForm = $this->checkErrors($cleanPost);
            header('location:/visitor/contact/index.html.twig');
            exit();
        }
        return $errorsForm;
    }
}




