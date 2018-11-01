<?php
/**
 * Created by PhpStorm.
 * User: wilder22
 * Date: 01/11/18
 * Time: 17:22
 */

namespace Controller;


class contactController extends AbstractController
{
    /**
     * @return array|string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function contact()
    {
        return $this->twig->render('Visitor/Contact/index.html.twig');

        $errors= [];
        $cleanPost = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            foreach ($_POST as $key => $value) {
                $cleanPost[$key] = trim($value);
            }

            if (empty($_post['firstName'])) {
                $errors['firstName'] = "Indiquer votre Prénom";
            } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['firstName'])) {
                $errors['firstName'] = "Votre prénom ne doit pas contenir des caractères spéciaux";
            }
            if (empty($_post['lastName'])) {
                $errors['lastName'] = "Indiquer votre Nom";
            } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['lastName'])) {
                $errors['lastName'] = "Votre nom ne doit pas contenir des caractères spéciaux";
            }
            if (empty($_post['msg'])) {
                $errors['msg'] = "Indiquer votre Message";
            }

            if (empty($_post['email'])) {
                $errors['email'] = "Indiquer votre Mail";
            } elseif (!preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{,}$/", $_POST['lastName'])) {
                $errors['email'] = "Votre mail  doit être correctement en format email";
            }

            header('location:/visitor/contact/index.html.twig');
            exit();
        }
        return $errors;
    }
}