<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

use Model\Category;
use Model\CategoryManager;

/**
 * Class CategoryController
 *
 */
class CategoryController extends AbstractController
{


    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        $CategoryManager = new CategoryManager($this->getPdo());
        $category = $CategoryManager->selectAll();

        return $this->twig->render('Category/index.html.twig', ['category' => $category]);
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
        $CategoryManager = new CategoryManager($this->getPdo());
        $category = $CategoryManager->selectOneById($id);

        return $this->twig->render('Category/show.html.twig', ['category' => $category]);
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
        $CategoryManager = new CategoryManager($this->getPdo());
        $category = $CategoryManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category->setTitle($_POST['title']);
            $CategoryManager->update($category);
        }

        return $this->twig->render('Category/edit.html.twig', ['category' => $category]);
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
            $CategoryManager = new CategoryManager($this->getPdo());
            $category = new Category();
            $category->setTitle($_POST['title']);
            $id = $CategoryManager->insert($category);
            header('Location:/category/' . $id);
        }

        return $this->twig->render('Category/add.html.twig');
    }


    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $CategoryManager = new CategoryManager($this->getPdo());
        $CategoryManager->delete($id);
        header('Location:/');
    }
}
