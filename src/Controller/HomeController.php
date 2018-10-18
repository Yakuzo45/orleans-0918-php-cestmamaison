<?php
/**
 * Created by PhpStorm.
 * User: wilder19
 * Date: 16/10/18
 * Time: 16:43
 */


namespace Controller;


/**
 * Class HomeController
 *
 * @package Controller
 */

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Visitor/Presentation/index.html.twig');
    }
}
