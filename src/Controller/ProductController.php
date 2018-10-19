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
    public function index()
    {
        $productManager = new ProductManager($this->getPdo());
        $products = $productManager->selectAll();

        return $this->twig->render('Admin/Product/index.html.twig', ['products' => $products]);
    }
}
