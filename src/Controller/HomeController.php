<?php



namespace Controller;

use Model\CategoryManager;
use Service\DropdownService;
use Model\ProductManager;
use Model\BrandManager;
use \Swift_SmtpTransport;
use \Swift_Mailer;
use \Swift_Message;

class HomeController extends AbstractController
{
    private $dropdownService;

    public function __construct()
    {
        parent::__construct();

        $this->dropdownService = new DropdownService();
    }

    public function index()
    {
        $brandManager = new BrandManager($this->getPdo());
        $highlightedBrands = $brandManager->selectHighlightedBrand();
        return $this->twig->render('Visitor/index.html.twig', [
            'highlightedBrands' => $highlightedBrands,
            'categories' => $this->dropdownService->getCategories(),
            'brands' => $this->dropdownService->getBrands(),
        ]);

    }
    public function presentation()
    {
        return $this->twig->render('Visitor/Presentation/index.html.twig',[
            'categories' => $this->dropdownService->getCategories(),
            'brands' => $this->dropdownService->getBrands(),
        ]);
    }

    public function productsByOneCategory(int $id)
    {
        $productManager = new ProductManager($this->getPdo());
        $productsAndCategory = $productManager->selectAllProductsByOneCategory($id);
        return $this->twig->render('Visitor/Category/showProductsWithCategory.html.twig',[
            'productAndCategory' => $productsAndCategory,
            'categories' => $this->dropdownService->getCategories(),
            'brands' => $this->dropdownService->getBrands(),
        ]);
    }

    public function productsByOneBrand(int $id)
    {
        $productManager = new ProductManager($this->getPdo());
        $productsAndBrand = $productManager->selectAllProductsByOneBrand($id);
        return $this->twig->render('Visitor/Brand/showProductsWithBrand.html.twig',[
            'productAndBrand' => $productsAndBrand,
            'categories' => $this->dropdownService->getCategories(),
            'brands' => $this->dropdownService->getBrands(),
        ]);
    }

    public function contact()
    {
        session_start();
        $errors= [];
        $cleanPost = [];
        $mailSent="";
        $mailNotSent ="";

        if (isset($_SESSION['mailSent']) && !empty($_SESSION['mailSent'])) {
            $mailSent =$_SESSION['mailSent'];
            unset($_SESSION['mailSent']);
        }
        if (isset($_SESSION['mailNotSent'])&& !empty($_SESSION['mailNotSent'])) {
            $mailNotSent =$_SESSION['mailNotSent'];
            unset($_SESSION['mailNotSent']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            foreach ($_POST as $key => $value) {
                $cleanPost[$key] = trim($value);
            }
            if ($_POST){

                if (empty($cleanPost['firstName'])) {
                    $errors['firstName'] = "Indiquer votre Prénom";
                } elseif (!preg_match("/^[a-zA-Z]+$/", $cleanPost['firstName'])) {
                    $errors['firstName'] = "Votre prénom ne doit pas contenir des caractères spéciaux";
                } elseif (strlen($cleanPost['firstName'])>50){
                    $errors['firstName']= 'Veuillez remplir le champ "Prénom" avec 50 caractères maxinum';
                }
                if (empty($cleanPost['lastName'])) {
                    $errors['lastName'] = "Indiquer votre Nom";
                } elseif (!preg_match("/^[a-zA-Z]+$/", $cleanPost['lastName'])) {
                    $errors['lastName'] = "Votre nom ne doit pas contenir des caractères spéciaux";
                } elseif (strlen($cleanPost['lastName'])>50){
                    $errors['lastName']= 'Veuillez remplir le champ "Nom" avec 50 caractères maximum';
                }
                if (empty($cleanPost['msg'])) {
                    $errors['msg'] = "Indiquer votre Message";
                }

                if (empty($cleanPost['email'])) {
                    $errors['email'] = "Indiquer votre Mail";
                } elseif (!filter_var($cleanPost['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Votre mail  doit être correctement en format email";
                } elseif (strlen($cleanPost['msg'])>50){
                    $errors['email']= 'Veuillez remplir le champ "E-mail" avec 50 caractères maximum';
                }
                if (empty($errors)){

                    try {
                        $transport = (new Swift_SmtpTransport(MAIL_TRANSPORT, MAIL_PORT))
                            ->setUsername(MAIL_USER)
                            ->setPassword(MAIL_PASSWORD)
                            ->setEncryption(MAIL_ENCRYPTION);
                        $mailer = new Swift_Mailer($transport);
                        $message = new Swift_Message();
                        $message->setSubject("Message du formulaire de contact du site C'est ma Maison");
                        $message->setFrom([$cleanPost['email'] => 'sender name']);
                        $message->addTo('wcs.cmm@gmail.com', 'recipient name');
                        $message->setBody("Vous avez un nouveau message de" . $cleanPost['lastName'] . " " . $cleanPost['firstName'] . " : " . $cleanPost['msg']);
                        $result=$mailer-> send($message);
                        $_SESSION['mailSent'] = 'Votre message a été envoyé';
                    }catch (\PDOException $e){
                        $_SESSION['mailNotSent'] = $e ->getMessage();
                    }
                    header('location:/contact');
                    exit();
                }
            }
        }
        return $this->twig->render('Visitor/Contact/index.html.twig',[
                                    'errors'=>$errors,
                                    'values'=>$cleanPost,
                                    'mailSent' =>$mailSent,
                                    'mailNotSent' =>$mailNotSent,
                                    'categories' => $this->dropdownService->getCategories(),
                                    'brands' => $this->dropdownService->getBrands(),
        ]);
    }
}




