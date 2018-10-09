<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 09/10/18
 * Time: 11:16
 */

namespace Controller;

use Model\Brands;
use Model\BrandsManager;

class BrandsController extends AbstractController
{
    public function index()
    {
        $BrandsManager = new BrandsManager($this->getPdo());
        $brands = $BrandsManager->selectAll();

        return $this->twig->render('Brands/indexBrands.html.twig', ['brand' => $brands]);
    }


    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function show(int $id)
    {
        $BrandsManager = new BrandsManager($this->getPdo());
        $brands = $BrandsManager->selectOneById($id);

        return $this->twig->render('Brands/showBrand.html.twig', ['brand' => $brands]);
    }


    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function edit(int $id): string
    {
        $BrandsManager = new BrandsManager($this->getPdo());
        $brands = $BrandsManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $brands->setTitle($_POST['title']);
            $BrandsManager->update($brands);
        }

        return $this->twig->render('Brands/editBrands.html.twig', ['brand' => $brands]);
    }


    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $BrandsManager = new BrandsManager($this->getPdo());
            $brands = new Brands();
            $brands->setTitle($_POST['title']);
            $id = $BrandsManager->insert($brands);
            header('Location:/brands/' . $id);
        }

        return $this->twig->render('Brands/addBrands.html.twig');
    }


    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $BrandsManager = new BrandsManager($this->getPdo());
        $BrandsManager->delete($id);
        header('Location:/brands');
    }
}