<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/27/17
 * Time: 9:10 PM
 */

namespace AppBundle\Controller\AdminController;


use AppBundle\Form\LoginForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;


class LoginFormController extends Controller
{
    /**
     * @Route("/bvusa-login", name="admin-login")
     */
    public function adminLogin(){

        $authUtils = $this->get('security.authentication_utils');

        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class,[
            '_username' => $lastUsername
        ]);

        return $this->render("FormView/LoginFormView.html.twig",[
            'error' => $error,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/bvusa-logout", name="admin-logout")
     */
    public function adminLogout(){
        //adminLogout will not do anything. The logout method is handled by security.yml.
        throw new Exception("There was an error logging you out.");

    }
}