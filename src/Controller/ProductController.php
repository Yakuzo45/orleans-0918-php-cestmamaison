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
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function show(int $id):string
    {
        $productManager = new ProductManager($this->getPdo());
        $product = $productManager->selectOneById($id);

        return $this->twig->render('Admin/Product/show.html.twig', ['product' => $product]) ;
    }
    public function delete(int $id)
    {
        $productManager = new ProductManager($this->getPdo());
        $productManager->delete($id);
        header('Location:/Admin/Product/index.html.twig');
    }
}
