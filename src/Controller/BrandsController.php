<?php
/**
 * Created by PhpStorm.
 * User: wilder19
 * Date: 10/10/18
 * Time: 15:03
 */


namespace Controller;
use Model\Brands;
use Model\BrandsManager;

/**
     * Display item creation page
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

class BrandsController extends AbstractController
{
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $BrandsManager = new BrandsManager($this->getPdo());
            $brands = new Brands();
            $brands->setName($_POST['name']);
            $id = $BrandsManager->insert($brands);
            header('Location:/admin/');
        }

        return $this->twig->render('Admin/brand/add.html.twig');
    }

}