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
    public function index():string
    {
        $productManager = new ProductManager($this->getPdo());
        $products = $productManager->selectAll();

        return $this->twig->render('Admin/Product/index.html.twig', ['products' => $products]);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $errors=[];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['deleteProduct'])) {

                $productManager = new ProductManager($this->getPdo());
                $productManager->delete($id);

                header('location:/admin/product/index');
                exit();
            }
        } else {
            $errors['post']= 'Echec de la suppression';
        }
        return $this->twig->render('Admin/Product/delete.html.twig');
    }
}
