<?php
/**
 * Created by PhpStorm.
 * User: billyvivant
 * Date: 16/10/18
 * Time: 17:04
 */

namespace Controller;


use Model\UserManager;


class UserController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        return $this->twig->render('User/Homepage/index.html.twig');
    }
}
