<?php
/**
 * Created by PhpStorm.
<<<<<<< HEAD
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
=======
 * User: wilder7
 * Date: 09/10/18
 * Time: 14:45
>>>>>>> 00ddbe8772b338e9ca1fcea2af8c9f99dafdc71e
 */

namespace Controller;


/**
 * Class AdminController
 *
 * @package Controller
 */

class AdminController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Admin/layoutAdmin.html.twig');
    }
}