<?php

/*
 * This file is part of the Admin package.
 *
 * (c) Ivan Proskuryakov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use UserBundle\Entity\User;
use LogicException;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Templating\EngineInterface;
use Swift_Mailer;
use ClubBundle\Entity\ClubInfo;
use CoachBundle\Entity\CoachInfo;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Manager for frontend users.
 *
 * @author Ivan Proskuryakov <volgodark@gmail.com>
 */
class UserManager implements UserProviderInterface
{

    /**
     * @var EncoderFactory
     */
    protected $encoder;

    /**
     * @var SecurityContext
     */
    protected $securityContext;

    /**
     * @var EntityManager
     */
    protected $dm;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var Swift_Mailer
     */
    protected $mailer;

    /**
     * @var string
     */
    protected $websiteEmail;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     * @param EncoderFactory $encoder
     * @param SecurityContext $securityContext
     * @param Swift_Mailer $mailer
     * @param EngineInterface $templating
     * @param string $websiteEmail
     */
    public function __construct(
        EntityManager $entityManager,
        EncoderFactory $encoder,
        SecurityContext $securityContext,
        Swift_Mailer $mailer,
        EngineInterface $templating,
        $websiteEmail,
        ContainerInterface  $container
    )
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->encoder = $encoder;
        $this->dm = $entityManager;
        $this->websiteEmail = $websiteEmail;
        $this->securityContext = $securityContext;
        $this->container    = $container;
    }

    /**
     * Get User repository
     */
    protected function getRepository()
    {
        $repo = $this->dm
            ->getRepository('UserBundle\Entity\User');

        return $repo;
    }

    /**
     * Get current user entity
     *
     * @param int $userId
     *
     * @return User $currentUser
     */
    public function getUser($userId = null)
    {
        if ($userId) return $this->loadById($userId);

        $userToken = $this->securityContext->getToken();
        if ($userToken) {
            $user = $userToken->getUser();

            if ($user !== 'anon.') {
                $roles = $user->getRoles();

                if (in_array('ROLE_USER', $roles)) return $user;
            }
        }

        return false;
    }

    /**
     * Get get session Id
     *
     * @return string $sessionId
     */
    public function getSessionId()
    {
        $sessionId = $this->getSession();

        return $sessionId;
    }

    /**
     * Is frontend user authenticated
     *
     * @return boolean
     */
    public function isAuthenticated()
    {

        $userToken = $this->securityContext->getToken();

        if ($userToken) {
            $user = $userToken->getUser();

            if ($user !== 'anon.') {
                /*$roles = $user->getRoles();

                if (in_array('ROLE_USER', $roles))
                */
                return true;
            }
        }

        return false;
    }

    /**
     * Is user password correct
     *
     * @param User $user
     * @param string $password
     *
     * @return boolean $isValid
     */
    public function checkUserPassword(User $user, $password)
    {
        $encoder = $this->encoder->getEncoder($user);

        if (!$encoder) {
            return false;
        }
        $isValid = $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());

        return $isValid;
    }

    /**
     * Creates user, specially for fixtures
     *
     * @param array $userData
     *
     * @return User $user
     */
    public function registerFixturesUser(array $userData)
    {
        $user = new User();
        $user->setEmail($userData['email']);
        $user->setUsername($userData['username']);
        $user->setPlainPassword($userData['password']);
        $user->setEnabled($userData['enabled']);
        $user->setLocked($userData['locked']);
        $user->setLastLogin(new \DateTime(date('Y-m-d H:i:s')));
        $user->setPhone($userData['phone']);
        $user->setWebsite($userData['website']);
        $user->setFacebook($userData['facebook']);
        $user->setTwitter($userData['twitter']);
        $user->setAbout($userData['about']);
        $tokenGenerator = md5($userData['email']);
        $user->setConfirmationToken($tokenGenerator);

        $this->dm->persist($user);
        $this->dm->flush();

        return $user;
    }

    /**
     * Update User details
     *
     * @param array $userData
     *
     * @return string $message
     */
    public function updateDetailsCurrentUser(array $userData)
    {
        try {
            $user = $this->findUserByEmail($userData['email']);

            if ($userData['password'])
            {
                $user->setPlainPassword($userData['password']);

                $salt = md5(uniqid(null, true));
                $user->setSalt($salt);

                $encoder = $this->encoder->getEncoder($user);
                $encodedPassword = $encoder->encodePassword(
                    $user->getPlainPassword(),
                    $user->getSalt()
                );
                $user->setPassword($encodedPassword);
                $user->setUsername($userData['username']);

                $this->dm->persist($user);
                $this->dm->flush();

            }
            
            $this->dm->persist($user);
            $this->dm->flush();
            $message = 'Information successfully updated!';
        } catch (\Swift_TransportException $e) {
            $message = $e->getMessage();
        }

        return $message;
    }

    /**
     * Register user and send userinfo by email
     */
    public function registerUser(array $userData)
    {

        $user = $this->loadUserByUsername($userData['username']);

        if (!$user) {
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setUsername($userData['username']);
            $user->setPlainPassword($userData['password']);
            $user->setLocked(false);
            $civility = $this->dm
                ->getRepository('CommunBundle\Entity\ListCivility')
                ->find($userData['civility']);
            $user->setCivility($civility);
            $user->setRoles($userData['roles']);
            $tokenGenerator = md5($userData['email'].$this->container->getParameter('token_mail'));
            $user->setConfirmationToken($tokenGenerator);
            $this->dm->persist($user);
            $this->dm->flush();

            // Send user info via email
            /* try {
                 $message = \Swift_Message::newInstance()
                     ->setSubject('New Account!')
                     ->setFrom($this->websiteEmail)
                     ->setTo($user->getEmail())
                     ->setBody(
                         $this->templating->render(
                             'UserBundle:Email:registration.txt.twig',
                             array(
                                 'username' => $user->getUsername(),
                                 'password' => $userData['password'],
                                 'email' => $user->getEmail(),
                             )
                         )
                     );

                 $this->mailer->send($message);
             } catch (\Swift_TransportException $e) {
             }
 */
            return $user;

        } else {
            return false;
        }

    }

    /**
     * Generate password string
     *
     * @param int $length
     *
     * @return string $password
     */
    public function generatePassword($length = 8)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($chars), 0, $length);

        return $password;
    }

    /**
     *   Reset and send password by email
     */
    public function resetPassword(User $user)
    {
        if ($user) {

            $password = $this->generatePassword();
            $user->setPlainPassword($password);
            $this->dm->persist($user);
            $this->dm->flush();
            return true;
            // Send password via email
          /* try {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Password reset')
                    ->setFrom($this->websiteEmail)
                    ->setTo($user->getEmail())
                    ->setBody(
                        $this->templating->render(
                            'UserBundle:Email:newPassword.txt.twig',
                            array(
                                'username' => $user->getUsername(),
                                'password' => $password,
                            )
                        )
                    );
                $response = $this->mailer->send($message);
            } catch (\Swift_TransportException $e) {
                $response = $e->getMessage();
            }

            return $response;*/
        } else {
            return false;
        }
    }

    public function loadUserByUsername($username)
    {
        $user = $this->getRepository()->findOneBy(array('username' => $username));

        return $user;
    }


    public function activeUser($token)
    {
        try{
            $user = $this->getRepository()->findOneBy(array('confirmationToken' => $token));
            if(count($user)>0)
            {
                if($user->getEnabled()==false)
                {
                    $user->setEnabled(true);
                    $this->dm->persist($user);
                    $this->dm->flush();
                    return array(
                        'message' => array(
                            'code' => "203",
                            'text' => "Compte acitivé avec succès."
                        ),
                        'result' => $user
                    );
                }
                else
                {
                    return array(
                        'message' => array(
                            'code' => "205",
                            'text' => "Compte déja activé."
                        ),
                        'result' => $user
                    );
                }
            }
            else
            {
                return array(
                    'message' => array(
                        'code' => "206",
                        'text' => "Erreur : token invalide."
                    ),
                    'result' => ''
                );
            }
            }   catch (\Exception $e)
                    {
                        return array(
                            'message' => array(
                                'code' => "500",
                                'text' => "Internal server error : ".$e->getMessage(),
                            ),
                            'result' => ""
                        );
                    }













    }



    public function loadById($id)
    {
        $user = $this->getRepository()->findOneBy(array('id' => $id));

        if (!$user) {
            throw new LogicException('User not found');
        }

        return $user;
    }

    public function findUserByEmail($email)
    {
        $user = $this->getRepository()->findOneBy(array('email' => $email));

        if (!$user) {
            throw new LogicException('User not found');
        }

        return $user;
    }

    public function findUserByEmailTest($email)
    {
        $user = $this->getRepository()->findOneBy(array('email' => $email));

        if (!$user) {
            return false;
        }

        return $user;
    }


    /**
     * @param $username
     * @param $email
     *
     * @return UserInterface
     */
    public function findUser($username, $email)
    {
        $user = $this
            ->getRepository()
            ->findOneBy(array(
                'username' => $username,
                'email' => $email,
            ));

        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);

        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.',
                    $class
                )
            );
        }

        return $this->find($user->getId());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        $name = 'UserBundle\Entity\User';

        return $name === $class || is_subclass_of($class, $name);
    }
    
    public function verifClubOrCoachOrMemberByUserRole($role, $id)
    {
        if ($this->isAuthenticated())
        {
            $current_user  = $this->securityContext->getToken()->getUser();

            if ($current_user && $current_user instanceof User && $current_user->getRoles() == $role)
            {
                switch ($role) 
                {
                    case "ROLE_CLUB":
                        $clubInfo = $current_user->getClubInfo();
                        if ($clubInfo && $clubInfo instanceof ClubInfo && $clubInfo->getId() == $id)
                        {
                            return $clubInfo;
                        } else
                        {
                            return array(
                                'message' => array(
                                    'code' => "400",
                                    'text' => "Access denied."
                                ),
                                'result' => ""
                            );
                        }
                        break;
                    case "ROLE_COACH":
                        $coachInfo = $current_user->getCoachInfo();
                        if ($coachInfo && $coachInfo instanceof CoachInfo && $coachInfo->getId() == $id)
                        {
                            return $coachInfo;
                        } else
                        {   
                            return array(
                                'message' => array(
                                    'code' => "400",
                                    'text' => "Access denied."
                                ),
                                'result' => ""
                            );
                        }
                        break;
                }
            } else 
            {
                return array(
                    'message' => array(
                        'code' => "400",
                        'text' => "Access denied."
                    ),
                    'result' => ""
                );
            }
        }
        return array(
            'message' => array(
                'code' => "400",
                'text' => "To authenticate to access."
            ),
            'result' => ""
        );
    }
    
    public function getCurrentUser()
    {
        $token = $this->securityContext->getToken();
        
        if ( $token->isAuthenticated() && $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY') )
        {
            return $token->getUser();
        }
        
        return array(
            'message' => array(
                'code' => "400",
                'text' => "You must be authenticated in order to access this service."
            ),
            'result' => ""
        );
    }
}
