<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 09/10/18
 * Time: 14:45
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
        return $this->twig->render('Admin/admin.html.twig');
    }
}