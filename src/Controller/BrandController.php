<?php
/**
 * Created by PhpStorm.
 * User: wilder19
 * Date: 10/10/18
 * Time: 15:03
 */


namespace Controller;
use Model\Brand;
use Model\BrandManager;

/**
     * Display brand creation page
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

class BrandController extends AbstractController
{
    public function add()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty(trim($_POST['name']))) {
                $errors['name'] = "La marque doit être renseignée !";

            } elseif (strlen(trim($_POST['name']))>255) {
                $errors['name'] = "La marque doit faire moins de 255 caractères";

            } else {
                $BrandManager = new BrandManager($this->getPdo());
                $brand = new Brand();
                $brand->setName(trim($_POST['name']));
                $id = $BrandManager->insert($brand);


                header('Location:/admin');
                exit();
            }

        }

        return $this->twig->render('Admin/brand/add.html.twig', ['error' => $errors]);
    }
    public function index()
    {
        $brandManager = new BrandManager($this->getPdo());
        $brands = $brandManager->selectAll();

        return $this->twig->render('Admin/brand/index.html.twig', ['brands' => $brands]);
    }

}

