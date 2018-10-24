<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 12/10/18
 * Time: 16:38
 */

namespace Controller;

use Model\Product;
use Model\ProductManager;

class ProductController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function add()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (preg_match("/^[a-zA-Z0-9]+$/",$_POST['name'])) {
                $errors['name'] = 'Veuillez remplir le champ "Nom" uniquement avec des caractères alphanumériques';
            }
            if (empty($_POST['name'])) {
                $errors['name'] = 'Veuillez remplir le champ "Nom" uniquement avec des caractères alphanumériques';
            } elseif (strlen($_POST['name']) < 255) {
                $errors['name'] = 'Veuillez remplir le champ "Nom" uniquement avec des 255 caractères alphanumériques maximum';
            }

            if (preg_match("/^[a-zA-Z0-9]+$/",$_POST['description'])) {
                $errors['description'] = 'Veuillez remplir le champ "Description" uniquement avec des caractères alphanumériques';
            }
            if (empty($_POST['description'])) {
                $errors['description'] = 'Veuillez remplir le champ "Description" uniquement avec des caractères alphanumériques';
            } elseif (strlen($_POST['description']) < 5000) {
                $errors['description'] = 'Veuillez remplir le champ "Nom" uniquement avec des 5000 caractères alphanumériques maximum';
            }

           if (preg_match(" /^[0-9]+$/",$_POST['price'])) {
               $errors['price'] = 'Veuillez remplir le champ "Prix" uniquement avec des caractères alphanumériques';
           }
            if (empty($_POST['price'])) {
                $errors['price'] = 'Veuillez remplir le champ "Prix"';
            } elseif ($_POST['price'] <= 0) {
                $errors['price'] = 'Veuillez remplir le champ "Prix" avec une valeur supérieur à 0';
            }

            if (preg_match("/^[a-zA-Z0-9]+$/",$_POST['category'])) {
                $errors['category'] = 'Veuillez remplir le champ "Catégorie" uniquement avec descaractères alphanumériques';
            }
            if (empty($_POST['category'])) {
                $errors['category'] = 'Veuillez remplir le champ "Catégorie" uniquement avec des caractères alphanumériques';
            } elseif (strlen($_POST['category']) < 255) {
                $errors['category'] = 'Veuillez remplir le champ "Catégorie" uniquement avec des 255 caractères alphanumériques maximum';
            }

            if (preg_match("/^[a-zA-Z0-9]+$/",$_POST['brand'])) {
                $errors['brand'] = 'Veuillez remplir le champ "Marque" uniquement avec des caractères alphanumériques';
            }
            if (empty($_POST['brand'])) {
                $errors['brand'] = 'Veuillez remplir le champ "Marque" uniquement avec des caractères alphanumériques';
            } elseif (strlen($_POST['brand']) < 255) {
                $errors['brand'] = 'Veuillez remplir le champ "Marque" uniquement avec des 255 caractères alphanumériques maximum';
            }
            if (empty($errors)) {
                $productManager = new ProductManager($this->getPdo());
                $product = new Product;
                $product->setName(trim(($_POST['name'])));
                $product->setName(trim(($_POST['price'])));
                $product->setName(trim(($_POST['description'])));
                $product->setName(trim(($_POST['category'])));
                $product->setName(trim(($_POST['brand'])));
                $product->setImage($fileName);
                $id = $productManager->insert($product);
            }
        }
        return $this->twig->render('Admin/Product/add.html.twig', ['errors' => $errors, 'values' => $_POST]);
    }

    public function index()
    {
        $productManager = new ProductManager($this->getPdo());
        $products = $productManager->selectAll();

        return $this->twig->render('Admin/Product/index.html.twig', ['products' => $products]);
    }
}
