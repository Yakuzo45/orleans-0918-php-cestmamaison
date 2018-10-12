<?php
/**
 * Created by PhpStorm.
 * User: billyvivant
 * Date: 10/10/18
 * Time: 10:09
 */

namespace Controller;
use Model\Category;
use Model\CategoryManager;

class CategoryController extends AbstractController
{
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = [];

            if (empty(trim($_POST['name']))) {
                $errors['name'] = "La catégorie doit être renseignée";
            } elseif (strlen($_POST['name']) > 255) {
                $errors['name'] = "La catégorie doit contenir moins de 255 caractères";
            } else {

                $categoryManager = new CategoryManager($this->getPdo());
                $category = new Category;
                $category->setName(($_POST['name']));
                $id = $categoryManager->insert($category);

                header('Location:/admin');
                exit();
            }
        }
        return $this->twig->render('Admin/Category/add.html.twig', ['error' => $errors]);
    }
}
