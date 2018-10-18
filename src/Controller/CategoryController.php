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
        $errors = [];
        $extension = ['png','jpg','jpeg'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty(trim($_POST['name']))) {
                $errors['name'] = "La catégorie doit être renseignée";
            } elseif (strlen(trim($_POST['name'])) > 255) {
                $errors['name'] = "La catégorie doit contenir moins de 255 caractères";
            } elseif (empty($_FILES['fichier']['name'])) {
                $errors['name'] = 'Vous devez mettre une image';
            } else {
                if ($_FILES) {
                    $length = filesize($_FILES['fichier']['tmp_name']);
                    $ext = explode('.', $_FILES['fichier']['name']);
                    if ($length > 1048576) {
                        $errors['name'] = 'Votre fichier ne peut exceder 1Mo';
                    } elseif (!in_array($ext[1], $extension)) {
                        $errors['name'] = 'Votre fichier peut uniquement posseder l\'extension ".png" , ".jpeg" ou ".jpg".';
                    } else {
                        $rename = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
                        $_FILES['fichier']['name'] = 'image' . uniqid() . '.' . $rename;
                        $uploadDir = 'assets/images/CategoryImages/';
                        $uploadFile = $uploadDir . basename($_FILES['fichier']['name']);
                        move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadFile);
                        $categoryManager = new CategoryManager($this->getPdo());
                        $category = new Category;
                        $category->setName(trim(($_POST['name'])));
                        $category->setImage($_FILES['fichier']['name']);
                        $id = $categoryManager->insert($category);
                        header('Location:/admin');
                        exit();

                    }
                }
            }
        }
        return $this->twig->render('Admin/Category/add.html.twig', ['error' => $errors]);
    }
}
