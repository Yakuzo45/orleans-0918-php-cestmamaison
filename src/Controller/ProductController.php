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
    const EXTENSION = ['png', 'jpeg', 'jpg'];
    const MAX_SIZE = 1048576;

    private function checkErrors(array $cleanPost)
    {
        $errors = [];
        $categoryManager = new CategoryManager($this->getPdo());
        $categories = $categoryManager->selectAll();

        $brandManager = new BrandManager($this->getPdo());
        $brands = $brandManager->selectAll();

        if (!preg_match("/^[a-zA-Z0-9]+$/", $cleanPost['name'])) {
            $errors['name'] = 'Veuillez remplir le champ "Nom" uniquement avec des caractères alphanumériques';
        }
        if (empty($cleanPost['name'])) {
            $errors['name'] = 'Le "Nom" du produit doit être renseignée!';
        } elseif (strlen($cleanPost['name']) > 255) {
            $errors['name'] = 'Veuillez remplir le champ "Nom" uniquement avec des 255 caractères maximum';
        }

        if (empty($cleanPost['description'])) {
            $errors['description'] = 'Veuillez remplir le champ "Description"';
        }
        if (!is_numeric((float)$cleanPost['price'])) {
            $errors['price'] = 'Veuillez remplir le champ "Prix" uniquement avec des caractères numériques';
        }
        if (empty($cleanPost['price'])) {
            $errors['price'] = 'Veuillez remplir le champ "Prix"';
        } elseif ($cleanPost['price'] <= 0) {
            $errors['price'] = 'Veuillez remplir le champ "Prix" avec des caractères numériques et  une valeur supérieur à 0';
        }

        if (empty($categoryManager->selectOneById(intval($cleanPost['category'])))) {
            $errors['category'] = 'Veuillez selectionner votre "Catégorie"';
        }

        if (empty($brandManager->selectOneById(intval($cleanPost['brand'])))) {
            $errors['brand'] = 'Veuillez selectionner votre "Marque"';
        }

        return $errors;
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function add()
    {
        $errors=[];
        $cleanPost = [];
        $categoryManager = new CategoryManager($this->getPdo());
        $categories = $categoryManager->selectAll();

        $brandManager = new BrandManager($this->getPdo());
        $brands = $brandManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            foreach ($_POST as $key => $value) {
                $cleanPost[$key] = trim($value);
            }

            $errors = $this->checkErrors($cleanPost);

            $length = filesize($_FILES['fichier']['tmp_name']);
            $ext = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
            if ($length > self::MAX_SIZE) {
                $errors[] = 'Votre fichier ne peut exceder' . self::MAX_SIZE/1000000 .'Mo';
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
                $product->setName($cleanPost['name']);
                $product->setPrice($cleanPost['price']);
                $product->setDescription($cleanPost['description']);
                $product->setBrandId($cleanPost['brand']);
                $product->setCategoryId($cleanPost['category']);
                $product->setPicture($fileName);
                $id = $productManager->insert($product);

                header('Location:/admin/product/index');
                exit();
            }
        }
        return $this->twig->render('Admin/Product/add.html.twig', [
            'errors' => $errors,
            'post' => $cleanPost,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function index(): string

    {
        $productManager = new ProductManager($this->getPdo());
        $products = $productManager->selectAll();

        return $this->twig->render('Admin/Product/index.html.twig', ['products' => $products]);
    }

    /**
     * @param int $id
     */
    public function delete()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['deleteProduct'])) {
                $productManager = new ProductManager($this->getPdo());
                $productManager->delete($_POST['deleteProduct']);

                header('location:/admin/product/index');
                exit();
            }
        }
    }
}
