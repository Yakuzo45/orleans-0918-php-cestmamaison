<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 12/10/18
 * Time: 16:38
 */

namespace Controller;

use model\Brand;
use Model\BrandManager;
use Model\Product;
use Model\ProductManager;
use Model\Category;
use Model\CategoryManager;


class ProductController extends AbstractController
{
    const EXTENSION = ['png','jpeg','jpg'];
    const MAX_SIZE = 1048576;
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function add()
    {
        $errors = [];

        $categoryManager = new CategoryManager($this->getPdo());
        $categories = $categoryManager->selectAll();

        $brandManager = new BrandManager($this->getPdo());
        $brands = $brandManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!preg_match("/^[a-zA-Z0-9]+$/",$_POST['name'])) {
                $errors['name'] = 'Veuillez remplir le champ "Nom" uniquement avec des caractères alphanumériques';
            }
            if (empty(trim($_POST['name']))) {
                $errors['name'] = 'Le "Nom" du produit doit être renseignée!';
            } elseif (strlen(trim($_POST['name'])) > 255) {
                $errors['name'] = 'Veuillez remplir le champ "Nom" uniquement avec des 255 caractères maximum';
            }

            if (!preg_match("/[a-z]{1,30}(,[a-z]{1,30})*/",$_POST['description'])) {
                $errors['description'] = 'Veuillez remplir le champ "Description" uniquement avec des caractères alphanumériques';
            }
            if (empty(trim($_POST['description']))) {
                $errors['description'] = 'Veuillez remplir le champ "Description"';
            } elseif (strlen(trim($_POST['description']))> 100) {
                $errors['description'] = 'Veuillez remplir le champ "Description" uniquement avec des 100 caractères maximum';
            }

           if (!preg_match(" /^([0-9]+[\.]?[0-9]*)\d$/",$_POST['price'])) {
               $errors['price'] = 'Veuillez remplir le champ "Prix" uniquement avec des caractères numériques';
           }

            if (empty(trim($_POST['price']))) {
                $errors['price'] = 'Veuillez remplir le champ "Prix"';
            } elseif ($_POST['price'] <= 0) {
                $errors['price'] = 'Veuillez remplir le champ "Prix" avec des caractères numériques et  une valeur supérieur à 0';
            }

            if (($_POST['category'] === 'Categories')) {
                $errors['category'] = 'Veuillez selectionner votre "Catégorie"';
            }

            if (($_POST['brand'] === 'Marques')) {
                $errors['brand'] = 'Veuillez selectionner votre "Marque"';
            }





            $length = filesize($_FILES['fichier']['tmp_name']);
            $ext = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
            if ($length > self::MAX_SIZE) {
                $errors[] = 'Votre fichier ne peut exceder 1Mo';
            } elseif ((!in_array($ext, self::EXTENSION)) and (!empty($_FILES['fichier']['name']))) {
                $errors[] = 'Votre fichier peut uniquement posseder l\'extension ' . implode(' , ', self::EXTENSION);
            }

            if (empty($_FILES['fichier']['name'])) {
                $errors[] = 'L\'image doit être renseignée';
            }



            if (empty($errors)) {
                $fileName = 'image' . uniqid() . '.' . $ext[1];
                $uploadDir = 'assets/images/ProductImages/';
                $uploadFile = $uploadDir . basename($fileName);
                move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadFile);

                $productManager = new ProductManager($this->getPdo());
                $product = new Product;
                $product->setName(trim(($_POST['name'])));
                $product->setPrice(trim(($_POST['price'])));
                $product->setDescription(trim(($_POST['description'])));
                $product->setBrandId((($_POST['brand'])));
                $product->setCategoryId((($_POST['category'])));
                $product->setPicture($fileName);
                $id = $productManager->insert($product);

                header('Location:/admin/product/index');
                exit();

            }
        }
        return $this->twig->render('Admin/Product/add.html.twig', ['errors' => $errors, 'product' => $_POST, 'categories' => $categories,'brands' => $brands]);
    }

    public function index()
    {
        $productManager = new ProductManager($this->getPdo());
        $products = $productManager->selectAll();

        return $this->twig->render('Admin/Product/index.html.twig', ['products' => $products]);
    }
}
