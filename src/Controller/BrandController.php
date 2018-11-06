<?php
/**
 * Created by PhpStorm.
 * User: wilder19
 * Date: 10/10/18
 * Time: 15:03
 */


namespace Controller;

use Model\Brand;
use Model\BrandManager;

/**
 * Display brand creation page
 *
 * @return string
 * @throws \Twig_Error_Loader
 * @throws \Twig_Error_Runtime
 * @throws \Twig_Error_Syntax
 */

class BrandController extends AbstractController
{
    const EXTENSION = ['png','jpeg','jpg'];
    const MAX_SIZE = 1048576;
    const MAX_HIGHLIGHTED = 3;

    /**
     * @return array
     */
    private function checkErrors()
    {

        if (empty(trim($_POST['name']))) {
            $errors[] = "La marque doit être renseignée";
        }
        if (strlen(trim($_POST['name'])) > 255) {
            $errors[] = "La marque doit contenir moins de 255 caractères";
        }
        if (empty($_FILES['fichier']['name'])) {
            $errors[] = 'L\'image doit être renseignée';
        }


        $length = filesize($_FILES['fichier']['tmp_name']);
        $ext = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
        if ($length > self::MAX_SIZE) {
            $errors[] = 'Votre fichier ne peut exceder 1Mo';
        } elseif ((!in_array($ext, self::EXTENSION)) and (!empty($_FILES['fichier']['name']))) {
            $errors[] = 'Votre fichier peut uniquement posseder l\'extension ' . implode(' , ', self::EXTENSION);
        }
        return $errors;
    }

    public function add()
    {
        $errors=[];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->checkErrors();
            if (empty($errors)) {
                $ext = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
                $fileName = 'image' . uniqid() . '.' . $ext;
                $uploadDir = 'assets/images/BrandImages/';
                $uploadFile = $uploadDir . basename($fileName);
                move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadFile);

                $brandManager = new BrandManager($this->getPdo());
                $brand = new Brand;
                $brand->setName(trim(($_POST['name'])));
                $brand->setPicture($fileName);
                $id = $brandManager->insert($brand);

                header('Location:/admin/brand');
                exit();
            }
        }

        return $this->twig->render('Admin/brand/add.html.twig', ['errors' => $errors]);
    }

    public function index()
    {
        $error=[];
        $brandManager = new BrandManager($this->getPdo());
        $brands = $brandManager->selectAll();
        if (isset($_GET['error'])) {
            $errors = explode('_', $_GET['error']);
            $error = implode(' ', $errors);
        }

        return $this->twig->render('Admin/brand/index.html.twig', ['brands' => $brands, 'error' =>$error]);
    }

    public function highlightedBrands(int $id)
    {
        $brandManager = new BrandManager($this->getPdo());
        $brand = $brandManager->selectOneById($id);
        $brands = $brandManager->selectHighlightedBrand();

        $length = count($brands);

        if (($length >= self::MAX_HIGHLIGHTED) && ($brand->isHighlightedBrand() == false)) {
            $error = "?error=Vous_ne_pouvez_pas_mettre_plus_de_" . self::MAX_HIGHLIGHTED . "_marques_en_avant";
        } else {
            $brandManager->updateHighlightedBrandById($brand);
        }
        header("Location:/admin/brand$error");
        exit();
    }


    public function update(int $id)
    {
        $errors=[];
        $brandManager = new BrandManager($this->getPdo());
        $brand = $brandManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->checkErrors();
            if (empty($errors)) {
                $ext = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
                $fileName = 'image' . uniqid() . '.' . $ext;
                $uploadDir = 'assets/images/BrandImages/';
                $uploadFile = $uploadDir . basename($fileName);
                move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadFile);
                $brand->setName(trim($_POST['name']));
                $brand->setPicture($fileName);
                $brandManager->update($brand);
                header('Location:/admin/brand');
                exit();
            }
        }
        return $this->twig->render('Admin/brand/update.html.twig', [
            'errors' => $errors,
            'brand' => $brand,
        ]);
    }
    public function delete()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['deleteBrand'])) {
                $brandManager = new BrandManager($this->getPdo());
                $brandManager->delete($_POST['deleteBrand']);

                header('location:/admin/brand');
                exit();
            }
        }
    }
}
