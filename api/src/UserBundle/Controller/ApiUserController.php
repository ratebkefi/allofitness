<?php

namespace UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcherInterface;
use UserBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;

class ApiUserController extends FOSRestController
{

    /**
     * Tester si L'utilsateur et connecté ou non .
     *
     * @ApiDoc(
     *   section="01. services d'utilisateur",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request $request the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function loginStatusAction()
    {
        /** @var UserBundle\Manager\UserManager $um */

        if ($this->isAuthenticated()) {
            return array('message' => 'You already logged in','status' => true);
        }
        else
        {
            return array('message' => 'You not logged in','status' => false);
        }
    }

    /**
     * Connexion  .
     *
     * @ApiDoc(
     *    section="01. services d'utilisateur",
     *   resource = true,
     *      parameters={
     *        {"name"="username", "dataType"="string", "required"=true, "description"="Your username"},
     *        {"name"="password", "dataType"="string", "required"=false, "description"="Your password"},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request $request the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function loginAction(Request $request)
    {


        /** @var UserBundle\Manager\UserManager $um */

        if (!$this->isAuthenticated()) {

            $username = $request->get('username');
            $password = $request->get('password');
            //$password = $username = "rateb33";
            $um = $this->get('user.manager');
            $user = $um->loadUserByUsername($username);

            if ((!$user instanceof User) || (!$um->checkUserPassword($user, $password))) {
                return array('message' => 'Wrong username or password!',
                    'status' => false
                );
            }
            $this->loginUser($user);

            return array(
                'user' => $user,
                'role' => $user->getRoles(),
                'status' => true,
                'message' => 'Successfully logged in'
            );

        }
        else
        {


            return array(
                'status' => true,
                'message' => 'You already logged in. Try to refresh page'
            );
        }

        return array('message' => 'Error in login action',
            'status' => false
        );
    }

    /**
     * Is User Authenticated
     *
     * @return boolean
     */
    private function isAuthenticated()
    {
        return $this->get('user.manager')->isAuthenticated();
    }

    /**
     * @param User $user
     */
    protected function loginUser(User $user)
    {
        $token = new UsernamePasswordToken($user, null, 'main', array('ROLE_ADMIN'));
        $this->get('security.context')->setToken($token);
        $this->get('session')->set('_security_main', serialize($token));
        return $token;
    }

    /**
     * Crée un nouvel utilisateur à partir des données soumises.
     *
     * @ApiDoc(
     *     section="01. services d'utilisateur",
     *   resource = true,
     *      parameters={
     *        {"name"="username", "dataType"="string", "required"=true, "description"="username"},
     *        {"name"="password", "dataType"="string", "required"=true, "description"="password"},
     *        {"name"="email", "dataType"="string", "required"=true, "description"="email"},
     *     {"name"="email", "dataType"="string", "required"=true, "description"="email"},
     *     {"name"="civility", "dataType"="integer", "required"=true, "description"="civility"},
     *      {"name"="role", "dataType"="string", "required"=true, "description"="role"},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     *
     * @param Request $request the request object
     *
     * @return String
     */
    public function registerAction(Request $request)
    {

      /*  if ($this->isAuthenticated())
            return array('message' => 'You already logged in, please logout first'); */

        $params = array(
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'email' => $request->get('email'),
			'roles' => $request->get('role'),
            'civility' => $request->get('civility'),
        );


        if ($this->get('user.manager')->findUser($params['username'], $params['email'])) {
        return array('message' => 'Username  already taken!');
        }
        if ($this->get('user.manager')->findUserByEmailTest( $params['email'])) {
            return array('message' => 'e-mail already taken!');
        }


        $user = $this->get('user.manager')->registerUser($params);

        if ($user) {
            $token = new UsernamePasswordToken($user, null, 'main', array('ROLE_ADMIN'));
            $this->get('security.context')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));
        }


        /*
        $title='Bienvenue chez Allofitness';
        $website ='allofitness.fr';
        $template='ClubBundle:Email:registerclub.html.twig';

        $data=array(
            'name' =>  $user->getUsername(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'civility' => 'Mr',
            'token'=> $club['result']->getIdUser()->getConfirmationToken(),
        );


        $response = $this->get('mailing.manager')->SendMail($title,$website,$template,$data);
 */
        return array(
            'user' => $user,
            'token' => $token,
            'role' => 'ROLE_ADMIN',
            'status' => true,
            'message' => 'Successfully registered'
        );

    }



    /**
     * Mot de passe oublié.
     *
     * @ApiDoc(
     *     section="01. services d'utilisateur",
     *   resource = true,
     *     parameters={
     *        {"name"="email", "dataType"="string", "required"=true, "description"="email "},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request $request the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */

    public function passwordForgotAction(Request $request)
    {
        if ($this->isAuthenticated()) {
            return array('message' => 'You already logged in, Please logout first');
        }
        $email = $request->get('email');

        if ($user = $this->get('user.manager')->findUserByEmail($email)) {
            $response = $this->get('user.manager')->resetPassword($user);

            if ($response != 1) {
                return array('message' => $response);
            }
        } else {
            return array('message' => 'User not found!');
        }

        $title='Nouveau mot de passe';
        $website ='allofitness.fr';
        $template='ClubBundle:Email:newpassword.html.twig';

        $data=array(
            'name'        => $user->getUsername(),
            'username'    => $user->getUsername(),
            'email'       => $user->getEmail(),
            'password'    => $user->getPlainPassword(),
            'civility'    => $user->getCivility()->getName(),
            'website_url' => $this->container->getParameter("website_url"),
        );
 

        $this->get('mailing.manager')->SendMail($title,$website,$template,$data);


        return array('status' => true, 'message' => 'New password has been sent!');
    }

    /**
     * se déconnecter.
     *
     * @ApiDoc(
     *     section="01. services d'utilisateur",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request $request the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function logoutAction()
    {
        $token = new AnonymousToken(null, new User());
        $this->get('security.context')->setToken($token);
        $this->get('session')->invalidate();
        return array('status' => true, 'message' => 'You have been successfully logged out!');
    }

    /**
     * Obtenir des informations de l'utilisateur.
     *
     * @ApiDoc(
     *     section="01. services d'utilisateur",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     *
     * @param Request $request the request object
     *
     * @return String
     */
    public function informationAction()
    {
        if ($this->isAuthenticated()) {
            $user = $this->get('security.context')->getToken()->getUser();

            return $user;
        }

        return false;
    }



    /**
     * Activation de l'utilisateur.
     *
     * @ApiDoc(
     *     section="01. services d'utilisateur",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     *
     * @param Request $request the request object
     *
     * @return String
     */

    public function activeUserAction($token)
    {

            $message = $this->get('user.manager')->activeUser($token);

            return $message;
    }




    /**
     * Mise à jour de l'utilisateur.
     *
     * @ApiDoc(
     *     section="01. services d'utilisateur",
     *   resource = true,
     *   parameters={
     *        {"name"="email", "dataType"="string", "required"=true, "description"="email"},
     *        {"name"="password", "dataType"="string", "required"=true, "description"="password"},
     *        {"name"="username", "dataType"="string", "required"=true, "description"="username"},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     *
     * @param Request $request the request object
     *
     * @return String
     */

    public function editAction(Request $request)
    {
        if ($this->isAuthenticated()) {
            $userData = array(
                'password' => $request->get('password'),
                'email' => $request->get('email'),
                'username' => $request->get('username'),
            );

            $message = $this->get('user.manager')->updateDetailsCurrentUser($userData);
            return array('status' => true, 'message' => $message);
        }
        return false;
    }
}
