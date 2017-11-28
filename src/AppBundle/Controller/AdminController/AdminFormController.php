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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminFormController extends Controller
{
    /**
     * @Route("/login",name="admin-login")
     */
    public function adminLogin(Request $request,AuthenticationUtils $authUtils){

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
}