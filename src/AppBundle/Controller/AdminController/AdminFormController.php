<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/27/17
 * Time: 9:10 PM
 */

namespace AppBundle\Controller\AdminController;


use AppBundle\Form\AdminForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminFormController extends Controller
{
    /**
     * @Route("/bv-security/admin/login", name="admin-login")
     */
    public function adminLogin(){

        $authUtils = $this->get('security.authentication_utils');

        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        $form = $this->createForm(AdminForm::class,[
            '_username' => $lastUsername
        ]);

        return $this->render("FormView/LoginFormView.html.twig",[
            'error' => $error,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/bv-security/admin/logout", name="admin-logout")
     */
    public function adminLogout(){
        //adminLogout will not do anything. The logout method is handled by security.yml.
        throw new Exception("There was an error logging you out.");
    }
}