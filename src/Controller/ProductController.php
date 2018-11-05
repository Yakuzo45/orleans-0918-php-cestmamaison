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
    const MAX_HIGHLIGHTED = 3;
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index():string
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
        $products = $productManager->selectHighlightedProduct();

        $length = count($products);

        if (($length >= self::MAX_HIGHLIGHTED) && ($product->isHighlightedProduct() == false)) {
            $error = urlencode("Vous ne pouvez pas mettre plus de " . self::MAX_HIGHLIGHTED . " produits en avant");
        } else {
            $productManager->updateHighlightedProductById($product);
        }
        header("Location:/admin/product/index?error=$error");
        exit();
    }
}
