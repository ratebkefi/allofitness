<?php

namespace CommunBundle\Manager;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use ClubBundle\Entity\ClubInfo;
use CommunBundle\Tools\Tools;
use UserBundle\Entity\User;
use CommunBundle\Entity\CustomerReviews;


class CustomerReviewsManager 
{
    /**
     *
     * @var EntityManagerInterface 
     */
    private $em;
    
    /**
     *
     * @var TokenStorageInterface 
     */
    private $context;
    
    /**
     *
     * @var ContainerInterface 
     */
    private $container;
    
    /**
     * 
     * @param EntityManagerInterface $em
     * @param TokenStorageInterface $context
     * @param ContainerInterface $container
     */
    function __construct( EntityManagerInterface $em, TokenStorageInterface $context, ContainerInterface $container ) 
    {
        $this->em           = $em;
        $this->context      = $context;
        $this->container    = $container;
    }

    public function findClubInfoBy(array $args, $one=true)
    {
        if ($one)
        {
            return  $this->em
                ->getRepository("ClubBundle:ClubInfo")
                ->findOneBy($args);
        }
        return  $this->em
            ->getRepository("ClubBundle:ClubInfo")
            ->findBy($args);
    }

    public function findCoachInfoBy(array $args, $one=true)
    {
        if ($one)
        {
            return  $this->em
                ->getRepository("CoachBundle:CoachInfo")
                ->findOneBy($args);
        }
        return  $this->em
            ->getRepository("CoachBundle:CoachInfo")
            ->findBy($args);
    }

    public function validateDataCustomerReviews(Request $request)
    {
        $attrs  = array( 'club_info', 'coach_info', 'text', 'note' );
        $status = $this->container->getParameter('status');
        
        $require_attrs  = '';
        $invalid_data   = '';
        
        $user_role = '';
        
        foreach ($attrs as $attr)
        {
            switch ($attr)
            {
                case 'club_info':
                case 'coach_info':                    
                    $id_club_info   = $request->request->get("club_info");
                    $id_coach_info  = $request->request->get("coach_info");
                    
                    if ( $id_club_info && $id_coach_info)
                    {
                        return array(
                            'message' => array(
                                'code' => "400",
                                'text' => "Must supply one of the two fields: Club_info or Coach_info."
                            ),
                            'result' => ""
                        );
                    } else if ( $id_club_info && $attr == 'club_info')
                    {
                        $club_info = $this->findClubInfoBy(array("id" => $id_club_info, "status" => $status["activate"]));
                        // verif ClubInfo is exist & activate by id
                        if ( !($club_info instanceof ClubInfo) ) // not valid
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        } else 
                        {
                            $user_role = 'ROLE_CLUB';
                        }
                    } else if ($id_coach_info && $attr == 'coach_info')
                    {
                        $coach_info = $this->findCoachInfoBy(array("id" => $id_coach_info, "status" => $status["activate"]));
                        // verif ClubInfo is exist & activate by id
                        if ( !($coach_info instanceof \CoachBundle\Entity\CoachInfo) ) // not valid
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        } else 
                        {
                            $user_role = 'ROLE_COACH';
                        }
                    }                    
                    break;
                case 'text':
                case 'note':
                    if ( !$request->request->get($attr) )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    }
                    
                    if ($attr == 'note' && $note = $request->request->get($attr))
                    {
                        if ( !Tools::isInt($note) || intval($note) < 0 || intval($note) > 5 )
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
            }
        }
        
        if ( !$request->request->get("club_info") && !$request->request->get("coach_info"))
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "You have to give one of the two fields : Club_info or Coach_info"
                ),
                'result' => ""
            );
        }
        
        if ($require_attrs || $invalid_data)
        {
            if ($require_attrs)
            {
                $require_attrs  = (substr_count($require_attrs, ',') >= 1) ? "The fields: $require_attrs are required. " : "The field: $require_attrs is required. ";
            }
            $invalid_data   = ($invalid_data) ? "Invalid data for: $invalid_data. " : '';

            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "$require_attrs$invalid_data"
                ),
                'result' => ""
            );
        }

        return $user_role;
    }
    
    public function addDataCustomerReviews(Request $request, User $current_user)
    {        
        $club_info  = $this->em->getRepository("ClubBundle:ClubInfo")->findOneById($request->request->get('club_info'));
        $coach_info = $this->em->getRepository("CoachBundle:CoachInfo")->findOneById($request->request->get('coach_info'));
        
        //Test : club / coach n'a pas le droit de commenté lui-même.        
        if (
                ($club_info && $club_info->getIdUser() && $club_info->getIdUser()->getId() == $current_user->getId()) ||
                ($coach_info && $coach_info->getIdUser() && $coach_info->getIdUser()->getId() == $current_user->getId())
            )
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "Has no right to commented himself.",
                ),
                'result' => ""
            );
        }
        
        $status = $this->container->getParameter('status');
        
        try
        {
            $text       = $request->request->get('text');
            $note       = $request->request->get('note');
            
            $customerReviews = new CustomerReviews();
            
            $customerReviews->setUser($current_user);
            $customerReviews->setClubInfo($club_info);
            $customerReviews->setCoachInfo($coach_info);
            $customerReviews->setText($text);
            $customerReviews->setNote($note);
            $customerReviews->setStatus($status['waiting']);
            
            $this->em->persist($customerReviews);
            $this->em->flush();
            
        } catch (\Exception $e)
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Internal server error.",
                ),
                'result' => ""
            );
        }

        return array(
            'message' => array(
                'code' => "200",
                'text' => "Added completed successfully."
            ),
            'result' => ""
        );
        
    }
    
    public function activateCustomerReviews(Request $request, User $current_user)
    {
        // validate role is admin
        if (!$current_user || $current_user->getRoles() !== 'ROLE_ADMIN')
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "Access denied."
                ),
                'result' => ""
            );
        }
        
        $status                 = $this->container->getParameter('status');
        $id_customer_reviews    = $request->request->get('id_customer_reviews');
        
        if (is_null($id_customer_reviews))
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "The fields: Id_customer_reviews are required."
                ),
                'result' => ""
            ); 
        } else if (!Tools::isInt($id_customer_reviews))
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "Invalid data for: Id_customer_reviews."
                ),
                'result' => ""
            ); 
        }
        
        $customer_reviews = $this->em->getRepository("CommunBundle:CustomerReviews")->findOneById($id_customer_reviews);
        
        if (!$customer_reviews || !$customer_reviews instanceof CustomerReviews)
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "Invalid data for: Id_customer_reviews."
                ),
                'result' => ""
            );
        } else if ($customer_reviews->getStatus() == $status['activate'])
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "This customer reviews already active.",
                ),
                'result' => ""
            );
        }
        
        try
        {
            $customer_reviews->setStatus($status['activate']);
            $this->em->flush();
            
        } catch (\Exception $e)
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Internal server error.",
                ),
                'result' => ""
            );
        }
        
        return array(
            'message' => array(
                'code' => "200",
                'text' => "Update completed successfully."
            ),
            'result' => ""
        );        
    }
    
    public function calculateMyReviews(Request $request)
    {
        $status                 = $this->container->getParameter('status');
        $id_customer_reviews    = $request->request->get('id_customer_reviews');
        
        $customer_reviews       = $this->em->getRepository("CommunBundle:CustomerReviews")->findOneById($id_customer_reviews);
        
        $object         = null;
        $args           = null;
        
        if ($customer_reviews->getClubInfo())
        {
            $object = $customer_reviews->getClubInfo();            
            $args   = array(
                'club_info'  => $object,
                'status'    => $status['activate']
            );
            
        } else if ($customer_reviews->getCoachInfo())
        {
            $object = $customer_reviews->getCoachInfo();
            $args   = array(
                'coach_info'  => $object,
                'status'    => $status['activate']
            );
        } else 
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "No club or coach."
                ),
                'result' => ""
            );
        }
        
        $moyReviews = $this->em->getRepository("CommunBundle:CustomerReviews")->getMoyReviews($args);
        
        try
        {
            $object->setMoyReviews($moyReviews);
            $this->em->flush();
            
        } catch (\Exception $e)
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Internal server error.",
                ),
                'result' => ""
            );
        }
        
        return array(
            'message' => array(
                'code' => "200",
                'text' => "Update completed successfully."
            ),
            'result' => ""
        );
    }
}
