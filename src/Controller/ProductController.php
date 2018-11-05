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
    const MAX_HIGHLIGHTED = 3;
    const EXTENSION = ['png', 'jpeg', 'jpg'];
    const MAX_SIZE = 1048576;

    private function checkErrors(array $cleanPost)
    {
        $errors = [];
        $categoryManager = new CategoryManager($this->getPdo());
        $categories = $categoryManager->selectAll();

        $brandManager = new BrandManager($this->getPdo());
        $brands = $brandManager->selectAll();


        if (empty($cleanPost['name'])) {
            $errors['name'] = 'Le "Nom" du produit doit être renseignée!';
        }
        if (strlen($cleanPost['name']) > 255) {
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
        }
        if ($cleanPost['price'] <= 0) {
            $errors['price'] = 'Le prix doit avoir une valeur supérieur à 0';
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
        $errors = [];
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
                $errors[] = 'Votre fichier ne peut exceder' . self::MAX_SIZE / 1000000 . 'Mo';
            } elseif ((!in_array($ext, self::EXTENSION)) and (!empty($_FILES['fichier']['name']))) {
                $errors[] = 'Votre fichier peut uniquement posseder l\'extension ' . implode(' , ', self::EXTENSION);
            }

            if (empty($_FILES['fichier']['name'])) {
                $errors[] = 'L\'image doit être renseignée';
            }

            if (empty($errors)) {
                $ext = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
                $fileName = 'image' . uniqid() . '.' . $ext;
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

        if (isset($_GET['error'])) {

            $error = urldecode($_GET['error']);
        }
        return $this->twig->render('Admin/Product/index.html.twig', ['products' => $products, 'error' =>$error]);
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
    public function highlightedProducts(int $id)
    {
        $productManager = new ProductManager($this->getPdo());
        $product = $productManager->selectOneById($id);
        $highlightedProducts = $productManager->selectHighlightedProduct();


        if ((count($highlightedProducts) === self::MAX_HIGHLIGHTED) && ($product->isHighlightedProduct() == false)) {
            $error = urlencode("Vous ne pouvez pas mettre plus de " . self::MAX_HIGHLIGHTED . " produits en avant");
        } else {
            $productManager->updateHighlightedProductById($product);
        }
        header("Location:/admin/product/index?error=$error");
        exit();

    public function update(int $id)
    {
        $errors = [];
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
                $errors[] = 'Votre fichier ne peut exceder' . self::MAX_SIZE / 1000000 . 'Mo';
            } elseif ((!in_array($ext, self::EXTENSION)) and (!empty($_FILES['fichier']['name']))) {
                $errors[] = 'Votre fichier peut uniquement posseder l\'extension ' . implode(' , ', self::EXTENSION);
            }

            if (empty($_FILES['fichier']['name'])) {
                $errors[] = 'L\'image doit être renseignée';
            }

            if (empty($errors)) {
                $fileName = 'image' . uniqid() . '.' . $ext;
                $uploadDir = 'assets/images/ProductImages/';
                $uploadFile = $uploadDir . basename($fileName);
                move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadFile);

                $productManager = new ProductManager($this->getPdo());
                $product = $productManager->selectOneById($id);
                $product->setName($cleanPost['name']);
                $product->setDescription($cleanPost['description']);
                $product->setPrice($cleanPost['price']);
                $product->setPicture($fileName);
                $product->setBrandId($cleanPost['brand']);
                $product->setCategoryId($cleanPost['category']);


                $productManager->update($product);

                header('Location:/admin/product/index');
                exit();
            }
        }
        return $this->twig->render('Admin/Product/update.html.twig', [
            'errors' => $errors,
            'post' => $cleanPost,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
}
