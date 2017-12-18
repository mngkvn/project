<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/27/17
 * Time: 11:53 PM
 */

namespace AppBundle\Security;


use AppBundle\Form\LoginForm;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormSecurity extends AbstractFormLoginAuthenticator
{


    /*
     * This authenticator will run on every request and everything starts on getCredentials method.
     *
     * This form needs to be added to services.yml and autowire configured to true.
     * After that it needs to be added to security.yml
     *
     * Constructor Dependency Injection: FormFactoryInterface,EntityManager,RouterIntefrace.
     *
     * __construct will get the form, entity manager for admin search, route after failed or successful match.
     * getCredentials will check, implement the LoginForm and will return null or anything.
     * If getCredentials returned null, I suppose it would be throwing invalidation but if
     * it returned anything, It will jump to the next authentication method which is getUser
     *
     * The class provider part in the security.yml will give us the user interface which will
     * refresh the user session and give us the username and etc.
     */

    private $formFactory, $em, $router, $passwordEncoder;

    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router, UserPasswordEncoder $passwordEncoder)
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getCredentials(Request $request)
    {
        //checks if the current route is admin-login and the method is POST. If not, then this authentication is skipped.
        $adminLoggingIn = $request->attributes->get("_route") == "admin-login" && $request->isMethod("POST");

        if(!$adminLoggingIn){
            return;
        }

        $LoginForm = $this->formFactory->create(LoginForm::class);
        $LoginForm->handleRequest($request);
        $adminInfo = $LoginForm->getData();

        $request->getSession()->set(Security::LAST_USERNAME,$adminInfo['_username']);
        //if a non-null value is returned, authentication goes to the next step which is getUser.
        return $adminInfo;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        //$credentials is the $adminInfo values from the getCredentials method
        $username = $credentials['_username'];

        if(!$username){
            return;
        }
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

        if($this->passwordEncoder->isPasswordValid($user, $password)){
            /*
             * If it returns true,it calls onAuthenticationSuccess method.
             */

            return true;
        }

        /*
         *If password doesn't match, it will redirect the admin back to the default login URL which will be processed
         * by the getLoginUrl method
         */
        throw new CustomUserMessageAuthenticationException("Invalid Password",["password-mismatch"],1);
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

    /*
     * Instead redirecting to login, redirect them to not found pages as the system
     * should access the login link directly. This will avoid clients to know
     * which route is the admin login and avoid attacks.
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        if($request->attributes->get('_route') != 'admin-login'){
            throw new NotFoundHttpException('Error message from getLoginUrl() on LoginFormSecurity. Do not redirect to loginForm.');
        }

        $url = $this->getLoginUrl();

        return new RedirectResponse($url);
    }
}