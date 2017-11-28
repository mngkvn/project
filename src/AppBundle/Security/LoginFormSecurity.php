<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/27/17
 * Time: 11:53 PM
 */

namespace AppBundle\Security;


use AppBundle\Form\AdminForm;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormSecurity extends AbstractFormLoginAuthenticator
{


    /*
     * This form needs to be added to services.yml and autowire configured to true.
     * After that it needs to be added to security.yml
     * Reason is as soon as we added it to services and security yml, every request will made to the server,
     * it will run through this and check if it was a login form.
     *
     * Dependencies: FormFactoryInterface,EntityManager,RouterIntefrace.
     *
     * __construct will implement the form, get entity manager for admin search, route after failed or successful match.
     * getCredentials will check, implement the AdminForm and will return null or anything.
     * If getCredentials returned null, I suppose it would be throwing invalidation but if
     * it returned anything, It will jump to the next authentication method which is getUser
     */

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router)
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
    }

    public function getCredentials(Request $request)
    {
        //checks if the current route is admin-login and the method is POST. If not, then it's just a normal entity insert.
        $adminLoggingIn = $request->attributes->get("_route") == "admin-login" && $request->isMethod("POST");

        if(!$adminLoggingIn){
            return;
        }

        $adminForm = $this->formFactory->create(AdminForm::class);
        $adminForm->handleRequest($request);
        $adminInfo = $adminForm->getData();

        //if a non-null value is returned, authentication goes to the next step which is getUser.
        return $adminInfo;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        //$credentials is the $adminInfo values from the getCredentials method
        $username = $credentials['_username'];

        /*
         * apply the entity manager and get the user by $username; If it will return null, guard authentication would fail.
         * If it's successful, it will call the method checkCredentials
         */
         return $this->em->getRepository('AppBundle:AdminEntity')->findOneBy(["username"=>$username]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        /*
         * This is the step when the password needed to be checked if matching.
         * $credentials is coming from the $adminInfo again.
         */
        $password = $credentials['_password'];

        /*
         * For now, let's just return a default password as I haven't included the password field in the entity yet.
         */
        if($password == 'project'){
            /*
             * If it returns true,it calls onAuthenticationSuccess method.
             */
            return true;
        }

        /*
         *If password doesn't match, it will redirect the admin back to the default login URL which will be processed
         * by the getLoginUrl method
         */
        return false;
    }
    //cannot use onAuthenticationFailure as getLoginUrl method is a requirement.

    protected function getLoginUrl()
    {
        return $this->router->generate('admin-login');
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        /*
         * Return to homepage if successful login
         */
        return new RedirectResponse($this->router->generate('homepage'));
    }
}