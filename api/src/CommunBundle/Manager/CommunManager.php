<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CommunBundle\Manager;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use CommunBundle\Tools\Tools;
use ClubBundle\Entity\ClubInfo;
use CoachBundle\Entity\CoachInfo;
use UserBundle\Entity\User;


class CommunManager 
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

    public function validateMonth(Request $request)
    {
        $month = $request->query->get('month');

        if (!$month)
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "The field: Month is required."
                ),
                'result' => ""
            );
        } else if ($month && !Tools::isMonth($month))
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "Invalid data for: Month."
                ),
                'result' => ""
            );
        }
        return true;
    }




    /**
     * modifier la satus de club
     */
    public function statusAd($status,$id)
    {

        try{

            $ad = $this->em
                ->getRepository('CommunBundle:ListAd')
                ->find($id);
            $ad->setStatus($status);
            $this->em->persist($ad);
            $this->em->flush();
        }

        catch (\Exception $e)
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Erreur Interne du Serveur : ".$e->getMessage(),
                ),
                'result' => ""
            );
        }
        return array(
            'message' => array(
                'code' => "200",
                'text' => "Status updater avec succès."
            ),
            'result' => $ad
        );

    }
    

    public function validateNumber(Request $request)
    {
        $number = $request->query->get('number');

        if (is_null($number))
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "The field: Number is required."
                ),
                'result' => ""
            );
        } else if ($number && !Tools::isInt($number))
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "Invalid data for: Number."
                ),
                'result' => ""
            );
        }
        return true;
    }
    
    public function listEvents(Request $request)
    {
        $status_params  = $this->container->getParameter('status');
        $month          = $request->query->get('month');
        $number         = $request->query->get('number');
        
        $args = array(
            'status' => $status_params['activate'],
            'limit' => (int) ($number/2),
            'orderBy' => array(
                'date' => "DESC"
            )
        );
        
        if ($month)
        {
            $date = new \DateTime("01-$month");
            
            $args['month'] = array(
                'from' => new \DateTime($date->format("d-m-Y")),
                'to' => new \DateTime($date->format("t-m-Y"))
            );
        }
        $outpout = array();
        
        $clubEvents     = $this->em->getRepository("ClubBundle:ClubEvent")->findClubEvents($args);
        foreach ($clubEvents as $clubEvent)
        {
            $event_dates = $clubEvent->getDates();
            $dates = array();
            
            foreach ($event_dates as $event_date)
            {
                if ($event_date->getDate()->format("Y-m") == $month || $event_date->getDate()->format("m-Y") == $month)
                {
                    $dates[] = $event_date->getDate()->format("Y-m-d");
                }
            }
            
            $outpout[] = array(
                'name' => $clubEvent->getTitle(),
                'date'  => implode(', ', array_unique($dates)),
                'url' => '#club-event',
                'id' => $clubEvent->getId(),
                'image' => ($clubEvent->getPhoto()) ? $clubEvent->getPhoto() : ''
            );
        }
        
        $adEvents    = $this->em->getRepository("CoachBundle:CoachEvent")->findCoachEvents($args);
        foreach ($adEvents as $adEvent)
        {
            $event_dates = $adEvent->getDates();
            $dates = array();
            
            foreach ($event_dates as $event_date)
            {
                if ($event_date->getDate()->format("Y-m") == $month || $event_date->getDate()->format("m-Y") == $month)
                {
                    $dates[] = $event_date->getDate()->format("Y-m-d");
                }
            }
            
            $outpout[] = array(
                'name' => $adEvent->getTitle(),
                'date'  => implode(', ', array_unique($dates)),
                'url' => '#coach-event',
                'id' => $adEvent->getId(),
                'image' => ($adEvent->getPhoto()) ? $adEvent->getPhoto() : ''
            );
        }
        
        if (!$outpout)
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "No data to display."
                ),
                'result' => ""
            );
        }
        
        $text = count($outpout) . " line";
        $text .= (count($outpout) > 1) ? "s." : ".";
        return array(
            'message' => array(
                'code' => "200",
                'text' => $text
            ),
            'result' => $outpout
        );
    }
    
    public function getTopRated(Request $request)
    {
        $number = $request->query->get('number');
        
        $args = array(
            'limit' => $number/2,
            'orderby' => array(
                'moyReviews' => 'DESC'
            )
        );
        
        $top_rated_club     = $this->em->getRepository("ClubBundle:ClubInfo")->findTopRated($args);
        $top_rated_coach    = $this->em->getRepository("CoachBundle:CoachInfo")->findTopRated($args);
        
        $output = array(
            'club'  => array(),
            'coach' => array()
        );
        
        // top rated club
        foreach ($top_rated_club as $club)
        {
            $date = $club->getDateAdd() ? $club->getDateAdd()->format('d / m / Y') : '';
            $output['club'][] = array(
                'name' => $club->getClubName(),
                'image' => "#",
                'note' => $club->getMoyReviews(),
                'date' => $date,
                'desc' => $club->getPresentation4()
            );
        }
        
        // top rated coach
        foreach ($top_rated_coach as $ad)
        {
            $date = $ad->getCreateDat() ? $ad->getCreateDat()->format('d / m / Y') : '';
            $output['coach'][] = array(
                'name' => $ad->getFirstName() . ' ' . $ad->getLastName(),
                'image' => $ad->getPhoto(),
                'note' => $ad->getMoyReviews(),
                'date' => $date,
                'desc' => '#'
            );
        }
        
        $text = 'Treatment successfully.';
        if (!$output['club'] && !$output['coach'])
        {
            $text = 'No data to display.';
        }
        
        return array(
                'message' => array(
                    'code' => "200",
                    'text' => $text
                ),
                'result' => $output
            );
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
    
    public function validateDataListCustomerReviews(Request $request)
    {
        $attrs  = array( 'club_info', 'coach_info', 'status' );
        $status = $this->container->getParameter('status');
        
        $require_attrs  = '';
        $invalid_data   = '';
        
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
                        }
                    } else if ($id_coach_info && $attr == 'coach_info')
                    {
                        $coach_info = $this->findCoachInfoBy(array("id" => $id_coach_info, "status" => $status["activate"]));
                        // verif ClubInfo is exist & activate by id
                        if ( !($coach_info instanceof CoachInfo) ) // not valid
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

        return true;
    }
    
    public function validateStatusListCustomerReviews(Request $request, User $current_user=null)
    {
        $status_params  = $this->container->getParameter('status');
        
        $status         = $request->request->get("status");
        
        if (is_null($status) || intval($status) == $status_params['waiting'])
        {
            // require auth as ROLE_ADMIN
            if ($current_user && $current_user->getRoles() == 'ROLE_ADMIN')
            {
                return true;
            } else
            {
                return array(
                    'message' => array(
                        'code' => "400",
                        'text' => "To authenticate as admin to access to this service."
                    ),
                    'result' => ""
                );
            }
            
        } else if (intval($status) == $status_params['activate'])
        {
            return true;
        } else
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "Invalid data for: Status."
                ),
                'result' => ""
            );
        }
    }
    
    public function listCustomerReviews(Request $request)
    {
        $club_info  = $request->request->get("club_info");
        $coach_info = $request->request->get("coach_info");
        $status     = $request->request->get("status");
        
        $args = array(
            'club_info' => $club_info,
            'coach_info' => $coach_info
        );
        
        if ( !is_null($status) )
        {
            $args['status'] = $status;
        }
        
        $customer_reviews = $this->em->getRepository("CommunBundle:CustomerReviews")->findBy($args);
        
        
        $output = array();
        
        foreach ($customer_reviews as $reviews)
        {
            $user = '';
            if ($coach = $reviews->getUser()->getCoachInfo())
            {
                $user = "{$coach->getFirstName()} {$coach->getLastName()}";
            } else 
            if ($club = $reviews->getUser()->getClubInfo())
            {
                $user = "{$club->getFirstNameResponsible()} {$club->getLastNameResponsible()}";
            }
            
            $output[] = array(
                'user' => $user,
                'text' => $reviews->getText(),
                'note' => $reviews->getNote(),
                'date' => $reviews->getDateAdd() ? $reviews->getDateAdd()->format('d/m/Y') : ''
            );
        }
        
        $text = count($output) . " line";
        $text .= (count($output) > 1) ? "s." : ".";
        
        return array(
            'message' => array(
                'code' => "200",
                'text' => "$text"
            ),
            'result' => $output
        );
        
    }
    
}
