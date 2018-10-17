<?php
/**
 * Created by PhpStorm.
 * User: wilder19
 * Date: 16/10/18
 * Time: 16:43
 */


namespace Controller;


/**
 * Class PresentationController
 *
 * @package Controller
 */

class PresentationController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('User/Presentation/index.html.twig');
    }
}
