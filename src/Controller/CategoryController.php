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

            if (empty($_POST['name'])) {
                $errors['name'] = "La catégorie doit être renseignée";
                return $this->twig->render('Admin/Category/add.html.twig', ['error' => $errors]);
            } else {

                $categoryManager = new CategoryManager($this->getPdo());
                $category = new Category;
                $category->setName($_POST['name']);
                $id = $categoryManager->insert($category);

                header('Location:/admin');
            }
        }
        return $this->twig->render('Admin/Category/add.html.twig');
    }
}
/*                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>*/