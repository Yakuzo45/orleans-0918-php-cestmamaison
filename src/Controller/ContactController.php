<?php
/**
 * Created by PhpStorm.
 * User: wilder22
 * Date: 01/11/18
 * Time: 17:22
 */

namespace Controller;

use \Swift_SmtpTransport;
use \Swift_Mailer;
use \Swift_Msg;

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
                } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+\@[a-zA-Z0-9.-]+\.[a-zA-Z]{,}$/", $cleanPost['email'])) {
                    $errors['email'] = "Votre mail  doit être correctement en format email";
                } elseif (strlen($cleanPost['msg'])>50){
                    $errors['email']= 'Veuillez remplir le champ "E-mail" avec 50 caractères maximum';
                }
                if (empty($errors)){

                    try {
                        $transport = (new Swift_SmtpTransport(MAIL_TRANSPORT, MAIL_PORT))
                            ->setUsername(MAIL_USER)
                            ->setPassword(MAIL_PASSWORD)
                            ->setEncrytion(MAIL_ENCRYPTION);
                        $mailer = new Swift_Mailer($transport);
                        $message = new Swift_Massage();
                        $message->setSubject("Message du formulaire de contact du site C'est ma Maison");
                        $message->setFrom([$cleanPost['email'] => 'sender name']);
                        $message->addTo('wcs.cmm@gmail.com', 'recipient name');
                        $message->setBody("Vous avez un nouveau message de" . $cleanPost['lastName'] . " " . $cleanPost['firstName'] . " : " . $cleanPost['msg']);
                        $result=$mailer-> send($message);
                        $_SESSION['mailSent'] = 'Votre message a été envoyé';
                    }catch (\Exception $e){
                        $_SESSION['mailNotSent'] = $e ->getMessage();
                    }
                    header('location:/visitor/contact/index.html.twig');
                    exit();
                }
            }
        }
        return $this->twig->render('Visitor/Contact/index.html.twig',['errors'=>$errors,'values'=>$cleanPost, 'mailSent' =>$mailSent, 'mailNotSent' =>$mailNotSent]);
    }
}