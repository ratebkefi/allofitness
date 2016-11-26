<?php

/*
 * This file is part of the Admin package.
 *
 * (c) Ivan Proskuryakov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClubBundle\Manager;

use CommunBundle\Entity\Adress;
use ClubBundle\Entity\ClubInfo;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use LogicException;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Templating\EngineInterface;
use Swift_Mailer;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ClubBundle\Entity\ClubActivitieTheme;
use ClubBundle\Entity\ClubActivitie;
use ClubBundle\Entity\ClubEquipement;
use ClubBundle\Entity\ClubConfort;
use ClubBundle\Entity\ClubService;
use ClubBundle\Entity\ClubActivitiesAmenitiesConfortServices;
use CommunBundle\Tools\Tools;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use ClubBundle\Entity\ClubTimeTable;
use ClubBundle\Entity\ClubAccess;
use ClubBundle\Entity\ClubEvent;
use ClubBundle\Entity\ClubEventDates;

/**
 * Manager for frontend users.
 *
 * @author Ivan Proskuryakov <volgodark@gmail.com>
 */
class ClubManager
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
     *
     * @param EntityManager $entityManager
     * @param EncoderFactory $encoder
     * @param SecurityContext $securityContext
     * @param Swift_Mailer $mailer
     * @param EngineInterface $templating
     * @param string $websiteEmail
     * @param ContainerInterface $container
     */
    public function __construct(
        EntityManager $entityManager,
        EncoderFactory $encoder,
        SecurityContext $securityContext,
        Swift_Mailer $mailer,
        EngineInterface $templating,
        $websiteEmail,
        ContainerInterface $container
    )
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->encoder = $encoder;
        $this->dm = $entityManager;
        $this->websiteEmail = $websiteEmail;
        $this->securityContext = $securityContext;
        $this->container = $container;
    }


    /**
     * modifier la satus de club
     */
    public function statusClub($status,$id)
    {

        try{

            $club = $this->dm
                ->getRepository('ClubBundle:ClubInfo')
                ->find($id);
            $club->setStatus($status);
            $this->dm->persist($club);
            $this->dm->flush();
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
            'result' => $club
        );

    }



    /**
     * Register user and send userinfo by email
     */
    public function registerClub(array $userData)
    {


        try{

            $user = new User();
            $user->setEmail($userData['email']);
            $user->setRoles('ROLE_CLUB');
            $user->setUsername($userData['email']);
            $user->setPlainPassword($userData['password']);
            $user->setLocked(false);
            $tokenGenerator = md5($userData['email']);
            $user->setConfirmationToken($tokenGenerator);


            $civility = $this->dm
                ->getRepository('CommunBundle\Entity\ListCivility')
                ->find($userData['civility']);
            $user->setCivility($civility);

            $this->dm->persist($user);

            $clubadress = new Adress();
            $clubadress->setAdress($userData['adress']);
            $clubadress->setAdressContinued($userData['adresse_contunied']);


            $country = $this->dm
                ->getRepository('CommunBundle\Entity\ListCountry')
                ->find($userData['country']);
            $clubadress->setIdCountry($country);

            $region = $this->dm
                ->getRepository('CommunBundle\Entity\ListRegion')
                ->find($userData['region']);
            $clubadress->setIdRegion($region);

            $departement = $this->dm
                ->getRepository('CommunBundle\Entity\ListDepartement')
                ->find($userData['departement']);
            $clubadress->setIdDepartement($departement);

            if(isset($userData['city']))
            {
                $city = $this->dm
                    ->getRepository('CommunBundle\Entity\ListCity')
                    ->find($userData['city']);
                $clubadress->setIdCity($city);

            }

            $clubadress->setIdCp($userData['cp']);
            $this->dm->persist($clubadress);

            $clubinfo = new ClubInfo();
            $clubinfo->setClubName($userData['club_name']);
            $clubinfo->setStatus(0);

            $clubnetwork = $this->dm
                ->getRepository('ClubBundle\Entity\ClubNetwork')
                ->find($userData['club_network']);
            $clubinfo->setIdNetwork($clubnetwork);

            $clubtype = $this->dm
                ->getRepository('ClubBundle\Entity\ListClubType')
                ->find($userData['club_type']);
            $clubinfo->setIdType($clubtype);

            $clubinfo->setIdAdress($clubadress);
            $clubinfo->setPhone($userData['phone']);
            $clubinfo->setCellphone($userData['cellphone']);
            $clubinfo->setUrlSite($userData['url_site']);

            $superficie = $this->dm
                ->getRepository('CommunBundle\Entity\ListArea')
                ->find($userData['superficie']);
            $clubinfo->setIdArea($superficie);

            $function= $this->dm
                ->getRepository('ClubBundle\Entity\ListClubFunction')
                ->find($userData['responsible_function']);
            $clubinfo->setIdFunction($function);

            $clubinfo->setFirstNameResponsible($userData['first_name_responsible']);
            $clubinfo->setLastNameResponsible($userData['last_name_responsible']);
            //$clubinfo->setResponsibleFunction($userData['responsible_function']);
            $clubinfo->setEmailOfThePersonContacted($userData['email_of_the_person_contacted']);
            $clubinfo->setEmailOfThePersonContactedCc($userData['email_of_the_person_contacted_cc']);
            $clubinfo->setIdUser($user);

            $this->dm->persist($clubinfo);
            $this->dm->flush();

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
                'text' => "Club enregistré avec succès."
            ),
            'result' => $clubinfo
        );


    }

    /**
     * Update Club  details
     *
     * @param array $clubInfoData
     *
     * @return string $message
     */
    public function updateDetailsClub(array $userData)
    {
        $clubinfo=  $this->dm->getRepository('ClubBundle:ClubInfo')
            ->find($userData['id']);


        if ($clubinfo)
        {
            try
            {

            $user=  $clubinfo->getIdUser();

            // $user->setEmail($userData['email']);
            $user->setRoles('ROLE_CLUB');
            $user->setUsername($userData['email']);
            $user->setPlainPassword($userData['password']);
            $user->setLocked(false);
            $civility = $this->dm
                ->getRepository('CommunBundle\Entity\ListCivility')
                ->find($userData['civility']);
            $user->setCivility($civility);
            $this->dm->persist($user);

            $clubadress=  $this->dm->getRepository('CommunBundle:Adress')
                ->find($clubinfo->getIdAdress()->getId());

            $clubadress->setAdress($userData['adress']);
            $clubadress->setAdressContinued($userData['adresse_contunied']);

            $country = $this->dm
                ->getRepository('CommunBundle\Entity\ListCountry')
                ->find($userData['country']);
            $clubadress->setIdCountry($country);

            $region = $this->dm
                ->getRepository('CommunBundle\Entity\ListRegion')
                ->find($userData['region']);
            $clubadress->setIdRegion($region);

            $departement = $this->dm
                ->getRepository('CommunBundle\Entity\ListDepartement')
                ->find($userData['departement']);
            $clubadress->setIdDepartement($departement);

            $city = $this->dm
                ->getRepository('CommunBundle\Entity\ListCity')
                ->find($userData['city']);
            $clubadress->setIdCity($city);


            $clubadress->setIdCp($userData['cp']);
            $this->dm->persist($clubadress);


            $clubinfo->setClubName($userData['club_name']);

            $clubnetwork = $this->dm
                ->getRepository('ClubBundle\Entity\ClubNetwork')
                ->find($userData['club_network']);
            $clubinfo->setIdNetwork($clubnetwork);

            $clubtype = $this->dm
                ->getRepository('ClubBundle\Entity\ListClubType')
                ->find($userData['club_type']);
            $clubinfo->setIdType($clubtype);


            $clubinfo->setIdAdress($clubadress);
            $clubinfo->setPhone($userData['phone']);
            $clubinfo->setCellphone($userData['cellphone']);
            $clubinfo->setUrlSite($userData['url_site']);

            $superficie = $this->dm
                ->getRepository('CommunBundle\Entity\ListArea')
                ->find($userData['superficie']);
            $clubinfo->setIdArea($superficie);

            $function= $this->dm
                ->getRepository('ClubBundle\Entity\ListClubFunction')
                ->find($userData['responsible_function']);
            $clubinfo->setIdFunction($function);

            $clubinfo->setFirstNameResponsible($userData['first_name_responsible']);
            $clubinfo->setLastNameResponsible($userData['last_name_responsible']);

            $clubinfo->setEmailOfThePersonContacted($userData['email_of_the_person_contacted']);
            $clubinfo->setEmailOfThePersonContactedCc($userData['email_of_the_person_contacted_cc']);
            $clubinfo->setIdUser($user);

            $this->dm->persist($clubinfo);
            $this->dm->flush();

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
            }

        return array(
            'message' => array(
                'code' => "200",
                'text' => "Club Modifié  avec succès."
            ),
            'result' => $clubinfo
        );
    }

    /**
     * Validate data for espace pro
     *
     * @param Request $request
     * @return boolean
     */
    public function validateDataActivitesAndEquipementsAndConfortAndServices(Request $request)
    {
        $attrs = array( 'club_info', 'address', 'latitude', 'longitude', 'activities', 'equipements', 'confort', 'services' );
        $require_attrs  = '';
        $invalid_data   = '';

        $status                 = $this->container->getParameter("status");

        foreach ($attrs as $attr)
        {
            switch ($attr)
            {
                case 'club_info':
                case 'address':
                    if ( !$request->request->get($attr) )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else if ($attr == "club_info" && $request->request->get($attr))
                    {
                        $id_club_info = $request->request->get($attr);
                        $club_info = $this->findClubInfoBy(array("id" => $id_club_info, "status" => $status["activate"]));
                        // verif ClubInfo is exist & activate by id
                        if ( !($club_info instanceof ClubInfo) ) // not valid
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
                case 'latitude':
                    $latitude = $request->request->get($attr);
                    if ( !$latitude )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else if ($latitude && !Tools::isLatitude($latitude))
                    {
                        $invalid_data .= ($invalid_data) ? ', ' : '';
                        $invalid_data .= ucfirst($attr);
                    }
                    break;
                case 'longitude':
                    $longitude = $request->request->get($attr);
                    if ( !$longitude )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else if ($longitude && !Tools::isLongitude($longitude))
                    {
                        $invalid_data .= ($invalid_data) ? ', ' : '';
                        $invalid_data .= ucfirst($attr);
                    }
                    break;
                case 'activities':
                    if ( !$request->request->get($attr) )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $activities = (array) json_decode($request->request->get($attr));
                        $invalid    = false;
                        if ( $activities )
                        {
                            foreach ($activities as $id_theme=>$ids_activity)
                            {
                                // validate id theme is int
                                if ( !preg_match('/^[0-9]+$/', $id_theme) )
                                {
                                    $invalid = true;
                                } else
                                {
                                    $theme = $this->findClubActivityThemeBy(array("id" => $id_theme, "status" => $status["activate"]));
                                    // verif ClubActivitieTheme is exist & activate by id
                                    if ( !($theme instanceof ClubActivitieTheme) ) // not valid
                                    {
                                        $invalid = true;
                                    } else // valid
                                    {
                                        $ids_activity = explode('|', $ids_activity);
                                        foreach ($ids_activity as $id_activity)
                                        {
                                            // validate id activity is int
                                            if ( !preg_match('/^[0-9]+$/', $id_activity) )
                                            {
                                                $invalid = true;
                                            } else
                                            {
                                                $activity = $this->findClubActivityBy(array("id" => $id_activity, "status" => $status["activate"]));
                                                // verif ClubActivitie is exist & activate by id
                                                if ( !($activity instanceof ClubActivitie) ) // not valid
                                                {
                                                    $invalid = true;
                                                } else
                                                {
                                                    // verif relation ClubActivitie & ClubActivitieTheme
                                                    if ($activity->getIdActivitieTheme() && $activity->getIdActivitieTheme()->getId() != $theme->getId())
                                                    {
                                                        $invalid = true;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if ($invalid || !$activities)
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
                case 'equipements':
                case 'confort':
                case 'services':
                    if ( !$request->request->get($attr) )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $$attr = (array) json_decode($request->request->get($attr));
                        $invalid    = false;
                        if ( $$attr )
                        {
                            foreach ($$attr as $id)
                            {
                                if ( !preg_match('/^[0-9]+$/', $id) )
                                {
                                    $invalid = true;
                                } else
                                {
                                    switch ($attr)
                                    {
                                        case 'equipements':
                                            $equipement = $this->findClubEquipementBy(array("id" => intval($id), "status" => $status["activate"]));
                                            // verif ClubEquipement is exist & activate by id
                                            if ( !($equipement instanceof ClubEquipement) ) // not valid
                                            {
                                                $invalid = true;
                                            }
                                            break;
                                        case 'confort':
                                            $service = $this->findClubConfortBy(array("id" => $id, "status" => $status["activate"]));
                                            // verif ClubConfort is exist & activate by id
                                            if ( !($service instanceof ClubConfort) ) // not valid
                                            {
                                                $invalid = true;
                                            }
                                            break;
                                        case 'services':
                                            $service = $this->findClubServiceBy(array("id" => $id, "status" => $status["activate"]));
                                            // verif ClubService is exist & activate by id
                                            if ( !($service instanceof ClubService) ) // not valid
                                            {
                                                $invalid = true;
                                            }
                                            break;
                                    }
                                }
                            }
                        }
                        if ($invalid || !$$attr)
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
            }
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

    /**
     * Add Activities To Club Info
     *
     * @param array Request $request
     * @param ClubInfo $clubInfo
     */
    public function addClubActivitiesAmenitiesConfortServices(Request $request, ClubInfo $clubInfo)
    {
        $status = $this->container->getParameter("status");

        try
        {
            $course_schedule        = $request->request->get("course_schedule");

            // create ClubActivitiesAmenitiesConfortServices
            $caacs = new ClubActivitiesAmenitiesConfortServices();
            $caacs->setCourseSchedule($course_schedule);
            $caacs->setStatus($status["waiting"]);
            $this->dm->persist($caacs);

            // Add ClubActivitie to ClubActivitiesAmenitiesConfortServices
            $activities = (array) json_decode($request->request->get("activities"));
            foreach ($activities as $ids_activities)
            {
                $ids_activities = explode('|', $ids_activities);
                foreach ($ids_activities as $id_activity)
                {
                    $caacs->addClubActivitie($this->findClubActivityBy(array("id" => $id_activity)));
                }
            }

            // Add Equipment to ClubActivitiesAmenitiesConfortServices
            $equipements = (array) json_decode($request->request->get("equipements"));
            foreach ($equipements as $id_equipement)
            {
                $caacs->addEquipment($this->findClubEquipementBy(array("id" => $id_equipement)));
            }

            // Add Confort to ClubActivitiesAmenitiesConfortServices
            $conforts = (array) json_decode($request->request->get("confort"));
            foreach ($conforts as $id_confort)
            {
                $caacs->addConfort($this->findClubConfortBy(array("id" => $id_confort)));
            }

            // Add Service to ClubActivitiesAmenitiesConfortServices
            $services = (array) json_decode($request->request->get("services"));
            foreach ($services as $id_service)
            {
                $caacs->addService($this->findClubServiceBy(array("id" => $id_service)));
            }

            $clubInfo->setIdClubActivitiesAmenitiesConfortServices($caacs);

            // set lat & long to address club
            $address = $clubInfo->getIdAdress();
            if ($address instanceof Adress)
            {
                $address->setAdress($request->request->get('address'));
                $address->setLatitude($request->request->get('latitude'));
                $address->setLongitude($request->request->get('longitude'));
            }

            $this->dm->flush();

        } catch (\Exception $e)
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Erreur Interne du Serveur.",
                ),
                'result' => ""
            );
        }

        return array(
            'message' => array(
                'code' => "200",
                'text' => "Enregistré avec succès."
            ),
            'result' => ""
        );
    }

    public function findClubInfoBy(array $args, $one=true)
    {
        if ($one)
        {
            return  $this->dm
                ->getRepository("ClubBundle:ClubInfo")
                ->findOneBy($args);
        }
        return  $this->dm
            ->getRepository("ClubBundle:ClubInfo")
            ->findBy($args);
    }

    public function findClubActivityThemeBy(array $args, $one=true)
    {
        if ($one)
        {
            return  $this->dm
                ->getRepository("ClubBundle:ClubActivitieTheme")
                ->findOneBy($args);
        }
        return  $this->dm
            ->getRepository("ClubBundle:ClubActivitieTheme")
            ->findBy($args);
    }

    public function findClubActivityBy(array $args, $one=true)
    {
        if ($one)
        {
            return  $this->dm
                ->getRepository("ClubBundle:ClubActivitie")
                ->findOneBy($args);
        }
        return  $this->dm
            ->getRepository("ClubBundle:ClubActivitie")
            ->findBy($args);
    }

    public function findClubEquipementBy(array $args, $one=true)
    {
        if ($one)
        {
            return  $this->dm
                ->getRepository("ClubBundle:ClubEquipement")
                ->findOneBy($args);
        }
        return  $this->dm
            ->getRepository("ClubBundle:ClubEquipement")
            ->findBy($args);
    }

    public function findClubConfortBy(array $args, $one=true)
    {
        if ($one)
        {
            return  $this->dm
                ->getRepository("ClubBundle:ClubConfort")
                ->findOneBy($args);
        }
        return  $this->dm
            ->getRepository("ClubBundle:ClubConfort")
            ->findBy($args);
    }

    public function findClubServiceBy(array $args, $one=true)
    {
        if ($one)
        {
            return  $this->dm
                ->getRepository("ClubBundle:ClubService")
                ->findOneBy($args);
        }
        return  $this->dm
            ->getRepository("ClubBundle:ClubService")
            ->findBy($args);
    }

    public function validateDataSchedules(Request $request)
    {
        $attrs = array( 'club_info', 'time_opening_am', 'time_closing_am', 'time_opening_pm', 'time_closing_pm', 'days' );
        $require_attrs  = '';
        $invalid_data   = '';
        $invalid_times  = '';
        $status         = $this->container->getParameter("status");
        $days_of_week   = $this->container->getParameter("days_of_week");

        foreach ($attrs as $attr)
        {
            switch ($attr)
            {
                case 'club_info':
                    $id_club_info = $request->request->get("club_info");
                    if ( !$id_club_info )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $club_info = $this->findClubInfoBy(array("id" => $id_club_info, "status" => $status["activate"]));
                        // verif ClubInfo is exist & activate by id
                        if ( !($club_info instanceof ClubInfo) ) // not valid
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
                case 'time_opening_am':
                case 'time_closing_am':
                case 'time_opening_pm':
                case 'time_closing_pm':
                    $time = $request->request->get($attr);
                    if (!$time)
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else if (!Tools::isTime($time))
                    {
                        $invalid_data .= ($invalid_data) ? ', ' : '';
                        $invalid_data .= ucfirst($attr);
                    }
                    break;
                case 'days':
                    $days = $request->request->get($attr);

                    if (!$days)
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $days = (array) json_decode($days);
                        $invalid = false;

                        if ($days)
                        {
                            foreach ($days as $day)
                            {
                                if (!in_array(strtolower($day), $days_of_week))
                                {
                                    $invalid = true;
                                }
                            }
                        }

                        if ($invalid || !$days)
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
            }
        }

        // Compare opening time with the closure
        $time_opening_am = $request->request->get("time_opening_am");
        $time_closing_am = $request->request->get("time_closing_am");
        $time_opening_pm = $request->request->get("time_opening_pm");
        $time_closing_pm = $request->request->get("time_closing_pm");

        if (
            Tools::isTime($time_opening_am) &&
            Tools::isTime($time_closing_am) &&
            Tools::compareTowTimes($time_opening_am, $time_closing_am) !== 2
        )
        {
            $invalid_times .= ($invalid_times) ? ', ' : '';
            $invalid_times .= "Time_opening_am < Time_closing_am";
        }

        if (
            Tools::isTime($time_closing_am) &&
            Tools::isTime($time_opening_pm) &&
            Tools::compareTowTimes($time_closing_am, $time_opening_pm) !== 2
        )
        {
            $invalid_times .= ($invalid_times) ? ', ' : '';
            $invalid_times .= "Time_closing_am < Time_opening_pm";
        }

        if (
            Tools::isTime($time_opening_pm) &&
            Tools::isTime($time_closing_pm) &&
            Tools::compareTowTimes($time_opening_pm, $time_closing_pm) !== 2
        )
        {
            $invalid_times .= ($invalid_times) ? ', ' : '';
            $invalid_times .= "Time_opening_pm < Time_closing_pm";
        }

        if ($require_attrs || $invalid_data || $invalid_times)
        {
            if ($require_attrs)
            {
                $require_attrs  = (substr_count($require_attrs, ',') >= 1) ? "The fields: $require_attrs are required. " : "The field: $require_attrs is required. ";
            }
            $invalid_data   = ($invalid_data) ? "Invalid data for: $invalid_data. " : '';
            $invalid_times   = ($invalid_times) ? "It is necessary that: $invalid_times. " : '';

            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "$require_attrs$invalid_data$invalid_times"
                ),
                'result' => ""
            );
        }

        return true;
    }

    public function validateDataAccess(Request $request)
    {

        $access_params  = $this->container->getParameter("access");
        $access         = $request->request->get("access");

        if (!$access)
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "The field: Access is required."
                ),
                'result' => ""
            );
        } else
        {
            $access = (array) json_decode($access);
            $invalid = false;

            if ($access)
            {
                foreach ($access as $acc=>$desc)
                {
                    if (!in_array(strtolower($acc), $access_params))
                    {
                        $invalid = true;
                    }
                }
            }
            if ($invalid || !$access)
            {
                return array(
                    'message' => array(
                        'code' => "400",
                        'text' => "Invalid data for: Access. "
                    ),
                    'result' => ""
                );
            }
        }

        return true;
    }

    public function addDataSchedulesAndAccess(Request $request, ClubInfo $clubInfo)
    {
        try
        {
            $status             = $this->container->getParameter("status");

            $days               = (array) json_decode($request->request->get('days'));
            $time_opening_am    = $request->request->get('time_opening_am');
            $time_closing_am    = $request->request->get('time_closing_am');
            $time_opening_pm    = $request->request->get('time_opening_pm');
            $time_closing_pm    = $request->request->get('time_closing_pm');
            $access             = (array) json_decode($request->request->get('access'));

            foreach ($days as $day)
            {
                $club_time_table = new ClubTimeTable();
                $club_time_table->setDay($day);
                $club_time_table->setIdClub($clubInfo);
                $club_time_table->setTimeOpeningAm(new \DateTime($time_opening_am));
                $club_time_table->setTimeClosingAm(new \DateTime($time_closing_am));
                $club_time_table->setTimeOpeningPm(new \DateTime($time_opening_pm));
                $club_time_table->setTimeClosingPm(new \DateTime($time_closing_pm));
                $club_time_table->setWholeweek($status['activate']);
                $this->dm->persist($club_time_table);
            }


            $club_access        = new ClubAccess();
            foreach ($access as $acc=>$desc)
            {
                switch ($acc)
                {
                    case "metro" :
                        $club_access->setMetro($status['activate']);
                        $club_access->setMetroDescription($desc);
                        break;

                    case "rer" :
                        $club_access->setRer($status['activate']);
                        $club_access->setRerDescription($desc);
                        break;

                    case "tramway" :
                        $club_access->setTramway($status['activate']);
                        $club_access->setTramwayDescription($desc);
                        break;

                    case "bus" :
                        $club_access->setBus($status['activate']);
                        $club_access->setBusDescription($desc);
                        break;

                    case "borne_velo" :
                        $club_access->setBorneVelo($status['activate']);
                        $club_access->setBorneVeloDescription($desc);
                        break;

                    case "parking" :
                        $club_access->setParking($status['activate']);
                        $club_access->setParkingDescription($desc);
                        break;

                    case "acces_routier_a_proximite" :
                        $club_access->setRoutier($status['activate']);
                        $club_access->setRoutierDescription($desc);
                        break;

                    case "autres" :
                        $club_access->setAutres($status['activate']);
                        $club_access->setAutresDescription($desc);
                        break;
                }
            }
            $this->dm->persist($club_access);

            $clubInfo->setIdAccess($club_access);

            $this->dm->flush();

        } catch (\Exception $e)
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Erreur Interne du Serveur.",
                ),
                'result' => ""
            );
        }

        return array(
            'message' => array(
                'code' => "200",
                'text' => "enregistré avec succès."
            ),
            'result' => ""
        );
    }

    public function validateDataPresentation(Request $request)
    {
        $attrs          = array( 'club_info', 'introduction', 'developpe', 'conclusion', 'mot_responsable_club' );
        $require_attrs  = '';
        $invalid_data   = '';
        $invalid_length = '';

        $status         = $this->container->getParameter("status");
        $str_length     = $this->container->getParameter("str_length");

        $no_presentation = true;

        foreach ($attrs as $attr)
        {
            switch ($attr)
            {
                case 'club_info':
                    $id_club_info = $request->request->get("club_info");
                    if ( !$id_club_info )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $club_info = $this->findClubInfoBy(array("id" => $id_club_info, "status" => $status["activate"]));
                        // verif ClubInfo is exist & activate by id
                        if ( !($club_info instanceof ClubInfo) ) // not valid
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
                case 'introduction':
                    $introduction = $request->request->get('introduction');
                    if ($introduction)
                    {
                        $no_presentation = false;
                        if (strlen($introduction) > $str_length['introduction_presentation_max'])
                        {
                            $invalid_length .= ($invalid_length) ? ', ' : '';
                            $invalid_length .= ucfirst($attr) . '<' . $str_length['introduction_presentation_max'];
                        }
                    }
                    break;
                case 'developpe':
                    $developpe = $request->request->get('developpe');
                    if ($developpe)
                    {
                        $no_presentation = false;
                        if (strlen($developpe) > $str_length['developpe_presentation_max'])
                        {
                            $invalid_length .= ($invalid_length) ? ', ' : '';
                            $invalid_length .= ucfirst($attr) . '<' . $str_length['developpe_presentation_max'];
                        }
                    }
                    break;
                case 'conclusion':
                    $conclusion = $request->request->get('conclusion');
                    if ($conclusion)
                    {
                        $no_presentation = false;
                        if (strlen($conclusion) > $str_length['conclusion_presentation_max'])
                        {
                            $invalid_length .= ($invalid_length) ? ', ' : '';
                            $invalid_length .= ucfirst($attr) . '<' . $str_length['conclusion_presentation_max'];
                        }
                    }
                    break;
                case 'mot_responsable_club':
                    $mot_responsable_club = $request->request->get('mot_responsable_club');
                    if ($mot_responsable_club)
                    {
                        $no_presentation = false;
                        if (strlen($mot_responsable_club) > $str_length['mot_responsable_club_max'])
                        {
                            $invalid_length .= ($invalid_length) ? ', ' : '';
                            $invalid_length .= ucfirst($attr) . '<' . $str_length['mot_responsable_club_max'];
                        }
                    }
                    break;
            }
        }

        // si aucun données à validé
        if ($no_presentation)
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "No data to insert."
                ),
                'result' => ""
            );
        }

        if ($require_attrs || $invalid_data || $invalid_length)
        {
            if ($require_attrs)
            {
                $require_attrs  = (substr_count($require_attrs, ',') >= 1) ? "The fields: $require_attrs are required. " : "The field: $require_attrs is required. ";
            }
            $invalid_data   = ($invalid_data) ? "Invalid data for: $invalid_data. " : '';
            $invalid_length = ($invalid_length) ? "It is necessary that the length of: $invalid_length. " : '';

            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "$require_attrs$invalid_data$invalid_length"
                ),
                'result' => ""
            );
        }

        return true;
    }

    public function addDataPresentation(Request $request, ClubInfo $clubInfo)
    {
        $introduction 		= $request->request->get('introduction');
        $developpe 		= $request->request->get('developpe');
        $conclusion 		= $request->request->get('conclusion');
        $mot_responsable_club   = $request->request->get('mot_responsable_club');

        try
        {
            $clubInfo->setPresentation1($introduction);
            $clubInfo->setPresentation2($developpe);
            $clubInfo->setPresentation3($conclusion);
            $clubInfo->setPresentation4($mot_responsable_club);

            $this->dm->flush();
        } catch (\Exception $e)
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Erreur Interne du Serveur.",
                ),
                'result' => ""
            );
        }

        return array(
            'message' => array(
                'code' => "200",
                'text' => "Updating completed successfully."
            ),
            'result' => ""
        );
    }

    public function validateDataInvitation(Request $request)
    {
        $attrs          = array( 'club_info', 'invitation' );
        $require_attrs  = '';
        $invalid_data   = '';

        $status         = $this->container->getParameter("status");




        foreach ($attrs as $attr)
        {
            switch ($attr)
            {
                case 'club_info':
                    $id_club_info = $request->request->get("club_info");
                    if ( !$id_club_info )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $club_info = $this->findClubInfoBy(array("id" => $id_club_info, "status" => $status["activate"]));
                        // verif ClubInfo is exist & activate by id
                        if ( !($club_info instanceof ClubInfo) ) // not valid
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
                case 'invitation':
                    $invitation = $request->request->get("invitation");
                    if (!$invitation)
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else if (!Tools::isInt($invitation))
                    {
                        $invalid_data .= ($invalid_data) ? ', ' : '';
                        $invalid_data .= ucfirst($attr);
                    }
                    break;
            }
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

    public function addDataInvitation(Request $request, ClubInfo $clubInfo)
    {
        $invitation = $request->request->get("invitation");

        try
        {
            $clubInfo->setInvitationAndDiscoveryPass($invitation);

            $this->dm->flush();
        } catch (\Exception $e)
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Erreur Interne du Serveur.",
                ),
                'result' => ""
            );
        }

        return array(
            'message' => array(
                'code' => "200",
                'text' => "Updating completed successfully."
            ),
            'result' => ""
        );
    }

    public function verifClub(Request $request)
    {
        $status         = $this->container->getParameter("status");
        $id_club_info   = $request->request->get("club_info");

        if ( !$id_club_info )
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "The field: Club_info is required."
                ),
                'result' => ""
            );
        } else
        {
            $club_info = $this->findClubInfoBy(array("id" => $id_club_info, "status" => $status["activate"]));
            // verif ClubInfo is exist & activate by id
            if ( !($club_info instanceof ClubInfo) ) // not valid
            {
                return array(
                    'message' => array(
                        'code' => "400",
                        'text' => "Invalid data for: Club_info."
                    ),
                    'result' => ""
                );
            }
        }
        return true;
    }

    public function validateStatus(Request $request)
    {
        $status_params = $this->container->getParameter('status');
        $status = $request->request->get('status');

        if ($status)
        {
            $status = (array) json_decode($status);
            $invalid = false;

            foreach ($status as $stts)
            {
                if (!in_array($stts, array($status_params['waiting'], $status_params['activate'], $status_params['removed'], $status_params['deactivate'])))
                {
                    $invalid = true;
                    break;
                }
            }

            if ($invalid || !$status)
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
        return true;
    }

    public function validateMonth(Request $request)
    {
        $month = $request->request->get('month');

        if ($month && !Tools::isMonth($month))
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
    
    public function findClubEventsBy(array $args, $one=true)
    {
        if ($one)
        {
            return  $this->dm
                    ->getRepository("ClubBundle:ClubEvent")
                    ->findOneBy($args);
        }
        return  $this->dm
                ->getRepository("ClubBundle:ClubEvent")
                ->findBy($args);
    }
    
    public function listEvents(Request $request, ClubInfo $clubInfo)
    {
        $status_params  = $this->container->getParameter('status');
        $status         = (!is_null($request->request->get('status'))) ? (array) json_decode($request->request->get('status')) : '';
        $month          = $request->request->get('month');
        
        $args = array(
            'idClub' => $clubInfo->getId()
        );
        
        if ($status)
        {
            $args['status'] = implode(',', $status);
        }
        if ($month)
        {
            $date = new \DateTime("01-$month");
            
            $args['month'] = array(
                'from' => new \DateTime($date->format("d-m-Y")),
                'to' => new \DateTime($date->format("t-m-Y"))
            );
        }
        
        $clubEvents = $this->dm->getRepository("ClubBundle:ClubEvent")->findClubEvents($args);
        
        $outpout = array();
        
        foreach ($clubEvents as $clubEvent)
        {
            
            $event_dates = $clubEvent->getDates();
            $dates = array();
            
            foreach ($event_dates as $event_date)
            {
                $dates[] = $event_date->getDate()->format("d/m/Y H\hi");
            }
            
            $outpout[] = array(
                'title' => $clubEvent->getTitle(),
                'dates'  => $dates,
                'description' => $clubEvent->getDescription(),
                'photo' => ($clubEvent->getPhoto()) ? $clubEvent->getPhoto() : ''
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

    public function validateDataEvent(Request $request)
    {
        $attrs          = array( 'club_info', 'title', 'dates', 'description' );
        $require_attrs  = '';
        $invalid_data   = '';
        $status         = $this->container->getParameter("status");
        
        foreach ($attrs as $attr)
        {
            switch ($attr)
            {
                case 'club_info':
                    $id_club_info = $request->request->get("club_info");
                    if ( !$id_club_info )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $club_info = $this->findClubInfoBy(array("id" => $id_club_info, "status" => $status["activate"]));
                        // verif ClubInfo is exist & activate by id
                        if ( !($club_info instanceof ClubInfo) ) // not valid
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
                case 'title':
                case 'description':
                    if (!$request->request->get($attr))
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    }
                    break;
                case 'dates':
                    if (!$request->request->get("dates"))
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $dates = array();
                        parse_str($request->request->get("dates"), $dates);
                        
                        $invalid = false;
                        if ( !$dates || !array_key_exists('date_event', $dates) || !array_key_exists('time_event', $dates))
                        {
                            $invalid = true;
                        } else if ( count($dates['date_event']) != count($dates['time_event']) )
                        {
                            $invalid = true;
                        }
                        
                        if ($invalid)
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
            }
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
    
    public function validateDataEventToUpdate(Request $request)
    {
        $attrs          = array( 'club_info', 'club_event' ,'dates' );
        $require_attrs  = '';
        $invalid_data   = '';
        $status         = $this->container->getParameter("status");
        
        foreach ($attrs as $attr)
        {
            switch ($attr)
            {
                case 'club_info':
                    $id_club_info = $request->request->get("club_info");
                    if ( !$id_club_info )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $club_info = $this->findClubInfoBy(array("id" => $id_club_info, "status" => $status["activate"]));
                        // verif ClubInfo is exist & activate by id
                        if ( !($club_info instanceof ClubInfo) ) // not valid
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
                case 'club_event':
                    $id_club_event = $request->request->get("club_event");
                    if ( !$id_club_event )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $club_event = $this->findClubEventsBy(array("id" => $id_club_event));
                        // verif ClubEvent is exist
                        if ( !($club_event instanceof ClubEvent) ) // not valid
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
                case 'dates':
                    if ($request->request->get("dates"))
                    {
                        $dates = array();
                        parse_str($request->request->get("dates"), $dates);
                        
                        $invalid = false;
                        if ( !$dates || !array_key_exists('date_event', $dates) || !array_key_exists('time_event', $dates))
                        {
                            $invalid = true;
                        } else if ( count($dates['date_event']) != count($dates['time_event']) )
                        {
                            $invalid = true;
                        }
                        
                        if ($invalid)
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
            }
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
    
    public function addEvent(Request $request, ClubInfo $clubInfo)
    {
        try
        {
            $status         = $this->container->getParameter("status");
            $title          = $request->request->get('title');
            $description    = $request->request->get('description');
            $photo          = $request->request->get('photo');
            
            $clubEvent = new ClubEvent();
            $clubEvent->setIdClub($clubInfo);
            $clubEvent->setTitle($title);
            $clubEvent->setDescription($description);
            $clubEvent->setStatus($status["waiting"]);
            $clubEvent->setPhoto($photo);
            
            $this->dm->persist($clubEvent);

            $dates          = array();
            parse_str($request->request->get('dates'), $dates);
            
            for ($i=0; $i<count($dates['date_event']); $i++) 
            {
                $date = new \DateTime($dates['date_event'][$i] . " " . $dates['time_event'][$i]);
                
                $clubEventDates = new ClubEventDates();
                $clubEventDates->setDate($date);
                $clubEventDates->setEvent($clubEvent);
                $this->dm->persist($clubEventDates);
            }
            
            $this->dm->flush();
        } catch (\Exception $e)
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Erreur Interne du Serveur.",
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
    
    public function updateEvent(Request $request, ClubInfo $clubInfo)
    {
        
        $id_club_event  = $request->request->get('club_event');
        $club_event     = $this->findClubEventsBy(array("id" => $id_club_event));

        if ($club_event->getIdClub()->getId() != $clubInfo->getId())
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "Invalid data for: Club_event.",
                ),
                'result' => ""
            );
        }
        
        try
        {
            $title          = $request->request->get('title');
            $description    = $request->request->get('description');
            $photo          = $request->request->get('photo');
            $status         = $request->request->get('status');
            
            if ($title) {
                $club_event->setTitle($title);
            }
            if ($description) {
                $club_event->setDescription($description);
            }
            if (Tools::isInt($status)) {
                $club_event->setStatus($status);
            }
            if ($photo) {
                $club_event->setPhoto($photo);
            }
            
            $this->dm->persist($club_event);

            if ($request->request->get('dates'))
            {
            $dates          = array();
            parse_str($request->request->get('dates'), $dates);
            
            for ($i=0; $i<count($dates['date_event']); $i++) 
            {
                $date = new \DateTime($dates['date_event'][$i] . " " . $dates['time_event'][$i]);
                
                    $eventDates = $this->dm->getRepository("ClubBundle:ClubEventDates")->findOneByDate($date);
                    if (!$eventDates instanceof ClubEventDates)
                    {
                $clubEventDates = new ClubEventDates();
                $clubEventDates->setDate($date);
                        $clubEventDates->setEvent($club_event);
                $this->dm->persist($clubEventDates);
            }
                }
            }
            
            $this->dm->flush();
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
    
    public function showEvent(Request $request, ClubInfo $clubInfo)
    {
        $id_club_event  = $request->request->get('club_event');

        if ( !$id_club_event )
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "The field: Club_event is required.",
                ),
                'result' => ""
            );
        } else if (
                    !Tools::isInt($id_club_event) || 
                    !$clubEvent = $this->dm->getRepository("ClubBundle:ClubEvent")->findOneBy(array('id' => $id_club_event, 'idClub' => $clubInfo))
                )
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Invalid data for: Club_event.",
                ),
                'result' => ""
            );
        }
        
        return $clubEvent;
    }
    
    public function deleteEvent(Request $request, ClubInfo $clubInfo)
    {
        $id_club_event  = $request->request->get('club_event');
        $status         = $this->container->getParameter("status");

        if ( !$id_club_event )
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "The field: Club_event is required.",
                ),
                'result' => ""
            );
        } else if (
                    !Tools::isInt($id_club_event) || 
                    !$clubEvent = $this->dm->getRepository("ClubBundle:ClubEvent")->findOneBy(array('id' => $id_club_event, 'idClub' => $clubInfo))
                )
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Invalid data for: Club_event.",
                ),
                'result' => ""
            );
        }
        
        try
        {
            
            $clubEvent->setStatus($status['removed']);
            
            $this->dm->flush();
            
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
                'text' => "Remove completed successfully."
            ),
            'result' => ""
        );
    }
}
