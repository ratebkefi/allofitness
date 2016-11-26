<?php

/*
 * This file is part of the Admin package.
 *
 * (c) Ivan Proskuryakov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CoachBundle\Manager;

use CoachBundle\Entity\CoachCourse;
use CommunBundle\Entity\Adress;
use CoachBundle\Entity\CoachInfo;
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
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use CommunBundle\Tools\Tools;
use CoachBundle\Entity\CoachEvent;
use CoachBundle\Entity\CoachEventDates;


/**
 * Manager for frontend users.
 *
 * @author Ivan Proskuryakov <volgodark@gmail.com>
 */
class CoachManager
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
     * modifier un coach
     */
    public function updateDetailsCoach(array $userData)
    {

        $coachinfo=  $this->dm->getRepository('CoachBundle:CoachInfo')
            ->find($userData['id']);


        if ($coachinfo) {

            try {

                $user = $coachinfo->getIdUser();
                $user->setEmail($userData['email']);
                $user->setUsername($userData['email']);
                $user->setRoles('ROLE_COACH');
                $user->setPlainPassword($userData['password']);
                $user->setLocked(false);
                $civility = $this->dm
                    ->getRepository('CommunBundle\Entity\ListCivility')
                    ->find($userData['civility']);
                $user->setCivility($civility);
                $this->dm->persist($user);
                $coachadress = $this->dm->getRepository('CommunBundle:Adress')
                    ->find($coachinfo->getIdAdress()->getId());

                $coachadress->setAdress($userData['adress']);
                $coachadress->setAdressContinued($userData['adresse_contunied']);

                $country = $this->dm
                    ->getRepository('CommunBundle\Entity\ListCountry')
                    ->find($userData['country']);
                $coachadress->setIdCountry($country);

                $region = $this->dm
                    ->getRepository('CommunBundle\Entity\ListRegion')
                    ->find($userData['region']);
                $coachadress->setIdRegion($region);

                $departement = $this->dm
                    ->getRepository('CommunBundle\Entity\ListDepartement')
                    ->find($userData['departement']);
                $coachadress->setIdDepartement($departement);

                if (isset($userData['city'])) {

                    $city = $this->dm
                        ->getRepository('CommunBundle\Entity\ListCity')
                        ->find($userData['city']);
                    $coachadress->setIdCity($city);

                }


                $coachadress->setIdCp($userData['cp']);
                $this->dm->persist($coachadress);


                $coachinfo->setStatus(0);
                $coachinfo->setFirstName($userData['first_name']);
                $coachinfo->setLastName($userData['last_name']);

                if (isset($data['diploma'])) {
                    $coachinfo->setDiploma($userData['diploma']);
                }
                if (isset($data['photo'])) {
                    $coachinfo->setPhoto($userData['photo']);
                }
                if (isset($data['business_card'])) {
                    $coachinfo->setKbis($userData['kbis']);
                }
                if (isset($data['diploma'])) {
                    $coachinfo->setBusinessCard($userData['business_card']);
                }
                if (isset($data['rib'])) {
                    $coachinfo->setRib($userData['rib']);
                }
                $coachinfo->setPhone($userData['phone']);
                $coachinfo->setBirthDate(new \DateTime($userData['birth_date']));
                $coachinfo->setIdAdress($coachadress);
                $coachinfo->setIdUser($user);
                $this->dm->persist($coachinfo);
                $this->dm->flush();
            }

            catch (\Exception $e)
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
        return array(
            'message' => array(
                'code' => "200",
                'text' => "Coach modifié avec succès."
            ),
            'result' => $coachinfo
        );

    }

    /**
     * Register user and send userinfo by email
     */
    public function registerCoach(array $userData)
    {
    try{

        $user = new User();
        $user->setEmail($userData['email']);
        $user->setUsername($userData['email']);
        $user->setRoles('ROLE_COACH');
        $user->setPlainPassword($userData['password']);
        $tokenGenerator = md5($userData['email']);
        $user->setConfirmationToken($tokenGenerator);
        $user->setLocked(false);

        $civility = $this->dm
            ->getRepository('CommunBundle\Entity\ListCivility')
            ->find($userData['civility']);

        $user->setCivility($civility);


        $this->dm->persist($user);

        $coachadress = new Adress();
        $coachadress->setAdress($userData['adress']);
        $coachadress->setAdressContinued($userData['adresse_contunied']);

        $country = $this->dm
            ->getRepository('CommunBundle\Entity\ListCountry')
            ->find($userData['country']);
        $coachadress->setIdCountry($country);

        $region = $this->dm
            ->getRepository('CommunBundle\Entity\ListRegion')
            ->find($userData['region']);
        $coachadress->setIdRegion($region);

        $departement = $this->dm
            ->getRepository('CommunBundle\Entity\ListDepartement')
            ->find($userData['departement']);
        $coachadress->setIdDepartement($departement);

        if(isset($userData['city']))
        {

            $city = $this->dm
                ->getRepository('CommunBundle\Entity\ListCity')
                ->find($userData['city']);
            $coachadress->setIdCity($city);

        }

        $coachadress->setIdCp($userData['cp']);
        $this->dm->persist($coachadress);

        $coachinfo = new CoachInfo();
        $coachinfo->setStatus(0);
        $coachinfo->setFirstName($userData['first_name']);
        $coachinfo->setLastName($userData['last_name']);
        $coachinfo->setDiploma($userData['diploma']);
        $coachinfo->setPhoto($userData['photo']);
        $coachinfo->setKbis($userData['kbis']);
        $coachinfo->setBusinessCard($userData['business_card']);
        $coachinfo->setRib($userData['rib']);
        $coachinfo->setPhone($userData['phone']);
        $coachinfo->setBirthDate(new \DateTime($userData['birth_date']));
        $coachinfo->setIdAdress($coachadress);
        $coachinfo->setIdUser($user);
        $this->dm->persist($coachinfo);
        $this->dm->flush();

    }
    catch (\Exception $e)
    {
        return array(
            'message' => array(
                'code' => "500",
                'text' => "Internal server error : ".$e->getMessage(),
            ),
            'result' => ""
        );
    }
        return array(
            'message' => array(
                'code' => "200",
                'text' => "Coach enregistré avec succès."
            ),
            'result' => $coachinfo
        );


    }

    /**
     * modifier la satus de club
     */
    public function statusCoach($status,$id)
    {

        try{

            $coach = $this->dm
                ->getRepository('CoachBundle:CoachInfo')
                ->find($id);
            $coach->setStatus($status);
            $this->dm->persist($coach);
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
            'result' => $coach
        );

    }


    /**
     * modifier la satus de cours
     */
    public function statusCourse($status,$id)
    {

        try{

            $cours = $this->dm
                ->getRepository('CoachBundle:CoachCourse')
                ->find($id);
            $cours->setStatus($status);
            $this->dm->persist($cours);
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
            'result' => $cours
        );

    }

    /**
     * Enregistrer un Cours
     */
    public function registerCourseCoach(array $userData)
    {

        try{
            $course = new CoachCourse();
            $coach = $this->dm
                ->getRepository('CoachBundle\Entity\CoachInfo')
                ->find($userData['id_coach']);

            $course->setIdCoach($coach);

            $categorie = $this->dm
                ->getRepository('CommunBundle\Entity\ListCourseCategory')
                ->find($userData['id_course_category']);

            $course->setIdCouseCategory($categorie);
            $course->setExperience($userData['experience']);

            foreach($userData['diploma'] as $dip)
            {
                $diploma = $this->dm
                    ->getRepository('CoachBundle\Entity\Diploma')
                    ->find($dip);
                $course->addDiploma($diploma);
            }

            foreach($userData['place'] as $pl)
            {
                $place = $this->dm
                    ->getRepository('CoachBundle\Entity\Place')
                    ->find($pl);
                $course->addPlace($place);
            }

            foreach($userData['primary_objective'] as $prim)
            {
                $primary_objective = $this->dm
                    ->getRepository('CoachBundle\Entity\PrimaryObjective')
                    ->find($prim);
                $course->addPrimaryObjective($primary_objective);
            }

            $movementRange = $this->dm
                ->getRepository('CoachBundle\Entity\MovementRange')
                ->find($userData['id_movementRange']);

            $course->setMovementRange($movementRange);
            $course->setDateUpdate(new \DateTime('now'));

            foreach($userData['id_number_of_persons'] as $nb)
            {
                $id_number_of_persons = $this->dm
                    ->getRepository('CoachBundle\Entity\NumberOfPersons')
                    ->find($nb);
                $course->addNumberOfPerson($id_number_of_persons);
            }

            $course->setServiceApproval($userData['service_approval']);
            $course->setPrice($userData['price']);

            $this->dm->persist($course);
            $this->dm->flush();

        }
        catch (\Exception $e)
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Internal server error : ".$e->getMessage(),
                ),
                'result' => ""
            );
        }
        return array(
            'message' => array(
                'code' => "200",
                'text' => "Cours enregistré avec succès."
            ),
            'result' => $course
        );


    }


    /**
     * Enregistrer un Cours
     */
    public function updateCourseCoach(array $userData)
    {


        $course=  $this->dm->getRepository('CoachBundle:CoachCourse')
            ->find($userData['id']);

        try{

            $categorie = $this->dm
                ->getRepository('CommunBundle\Entity\ListCourseCategory')
                ->find($userData['id_course_category']);

            $course->setIdCouseCategory($categorie);

            $course->setExperience($userData['experience']);

            $diplomas=$course->getDiploma();
            foreach($diplomas as $value){
                $course->removeDiploma($value);
            }

            foreach($userData['diploma'] as $dip)
            {
                $diploma = $this->dm
                    ->getRepository('CoachBundle\Entity\Diploma')
                    ->find($dip);
                $course->addDiploma($diploma);
            }

            $places=$course->getPlace();
            foreach($places as $value){
                $course->removePlace($value);

            }
            foreach($userData['place'] as $pl)
            {
                $place = $this->dm
                    ->getRepository('CoachBundle\Entity\Place')
                    ->find($pl);
                $course->addPlace($place);
            }

            $primary_objectives=$course->getPrimaryObjective();
            foreach($primary_objectives as $value){
                $course->removePrimaryObjective($value);
            }

            foreach($userData['primary_objective'] as $prim)
            {
                $primary_objective = $this->dm
                    ->getRepository('CoachBundle\Entity\PrimaryObjective')
                    ->find($prim);
                $course->addPrimaryObjective($primary_objective);
            }


            $movementRange = $this->dm
                ->getRepository('CoachBundle\Entity\MovementRange')
                ->find($userData['id_movementRange']);

            $course->setMovementRange($movementRange);

            $course->setDateUpdate(new \DateTime('now'));


            $number_of_persons=$course->getNumberOfPersons();
            foreach($number_of_persons as $value){
                $course->removeNumberOfPerson($value);
            }

            foreach($userData['id_number_of_persons'] as $nb)
            {
                $id_number_of_persons = $this->dm
                    ->getRepository('CoachBundle\Entity\NumberOfPersons')
                    ->find($nb);
                $course->addNumberOfPerson($id_number_of_persons);
            }

            $course->setServiceApproval($userData['service_approval']);
            $course->setPrice($userData['price']);

            $this->dm->persist($course);
            $this->dm->flush();



        }
        catch (\Exception $e)
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Internal server error : ".$e->getMessage(),
                ),
                'result' => ""
            );
        }
        return array(
            'message' => array(
                'code' => "200",
                'text' => "Cours modifié avec succès."
            ),
            'result' => $course
        );


    }

    public function findCoachInfoBy(array $args, $one=true)
    {
        if ($one)
        {
            return  $this->dm
                ->getRepository("CoachBundle:CoachInfo")
                ->findOneBy($args);
        }
        return  $this->dm
            ->getRepository("CoachBundle:CoachInfo")
            ->findBy($args);
    }

    public function findCoachEventBy(array $args, $one=true)
    {
        if ($one)
        {
            return  $this->dm
                ->getRepository("CoachBundle:CoachEvent")
                ->findOneBy($args);
        }
        return  $this->dm
            ->getRepository("CoachBundle:CoachEvent")
            ->findBy($args);
    }

    public function verifCoach(Request $request)
    {
        $status         = $this->container->getParameter("status");
        $id_coach_info  = $request->request->get("coach_info");

        if ( !$id_coach_info )
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "The field: Coach_info is required."
                ),
                'result' => ""
            );
        } else
        {
            $coach_info = $this->findCoachInfoBy(array("id" => $id_coach_info, "status" => $status["activate"]));
            // verif CoachInfo is exist & activate by id
            if ( !($coach_info instanceof CoachInfo) ) // not valid
            {
                return array(
                    'message' => array(
                        'code' => "400",
                        'text' => "Invalid data for: Coach_info."
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
    
    public function listEvents(Request $request, CoachInfo $coachInfo)
    {
        $status_params  = $this->container->getParameter('status');
        $status         = (!is_null($request->request->get('status'))) ? (array) json_decode($request->request->get('status')) : '';
        $month          = $request->request->get('month');
        
        $args = array(
            'idCoach' => $coachInfo->getId()
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
        
        $coachEvents = $this->dm->getRepository("CoachBundle:CoachEvent")->findCoachEvents($args);
        
        $outpout = array();
        
        foreach ($coachEvents as $coachEvent)
        {
            
            $event_dates = $coachEvent->getDates();
            $dates = array();
            
            foreach ($event_dates as $event_date)
            {
                $dates[] = $event_date->getDate()->format("d/m/Y H\hi");
            }
            
            $outpout[] = array(
                'title' => $coachEvent->getTitle(),
                'dates'  => $dates,
                'description' => $coachEvent->getDescription(),
                'photo' => ($coachEvent->getPhoto()) ? $coachEvent->getPhoto() : ''
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
        $attrs          = array( 'coach_info', 'title', 'dates', 'description' );
        $require_attrs  = '';
        $invalid_data   = '';
        $status         = $this->container->getParameter("status");
        
        foreach ($attrs as $attr)
        {
            switch ($attr)
            {
                case 'coach_info':
                    $id_coach_info = $request->request->get("coach_info");
                    if ( !$id_coach_info )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $coach_info = $this->findCoachInfoBy(array("id" => $id_coach_info, "status" => $status["activate"]));
                        // verif CoachInfo is exist & activate by id
                        if ( !($coach_info instanceof CoachInfo) ) // not valid
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
        $attrs          = array( 'coach_info', 'coach_event' ,'dates' );
        $require_attrs  = '';
        $invalid_data   = '';
        $status         = $this->container->getParameter("status");
        
        foreach ($attrs as $attr)
        {
            switch ($attr)
            {
                case 'coach_info':
                    $id_coach_info = $request->request->get("coach_info");
                    if ( !$id_coach_info )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $coach_info = $this->findCoachInfoBy(array("id" => $id_coach_info, "status" => $status["activate"]));
                        // verif CoachInfo is exist & activate by id
                        if ( !($coach_info instanceof CoachInfo) ) // not valid
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
                case 'coach_event':
                    $id_coach_event = $request->request->get("coach_event");
                    if ( !$id_coach_event )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $coach_event = $this->findCoachEventBy(array("id" => $id_coach_event));
                        // verif CoachEvent is exist
                        if ( !($coach_event instanceof CoachEvent) ) // not valid
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
    
    public function addEvent(Request $request, CoachInfo $coachInfo)
    {        
        try
        {
            $status         = $this->container->getParameter("status");
            $title          = $request->request->get('title');
            $description    = $request->request->get('description');
            $photo          = $request->request->get('photo');
            
            $coachEvent = new CoachEvent();
            $coachEvent->setIdCoach($coachInfo);
            $coachEvent->setTitle($title);
            $coachEvent->setDescription($description);
            $coachEvent->setStatus($status["waiting"]);
            $coachEvent->setPhoto($photo);
            
            $this->dm->persist($coachEvent);

            $dates          = array();
            parse_str($request->request->get('dates'), $dates);
            
            for ($i=0; $i<count($dates['date_event']); $i++) 
            {
                $date = new \DateTime($dates['date_event'][$i] . " " . $dates['time_event'][$i]);
                
                $coachEventDates = new CoachEventDates();
                $coachEventDates->setDate($date);
                $coachEventDates->setEvent($coachEvent);
                $this->dm->persist($coachEventDates);
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
                'text' => "Added completed successfully."
            ),
            'result' => ""
        );
    }
    
    public function updateEvent(Request $request, CoachInfo $coachInfo)
    {
        
        $id_coach_event = $request->request->get('coach_event');
        $status_params  = $this->container->getParameter("status");
        $coach_event    = $this->findCoachEventBy(array("id" => $id_coach_event));
        
        if ($coach_event->getIdCoach()->getId() != $coachInfo->getId())
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "Invalid data for: Coach_event.",
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
                $coach_event->setTitle($title);
            }
            if ($description) {
                $coach_event->setDescription($description);
            }
            if (Tools::isInt($status)) {
                $coach_event->setStatus($status);
            }
            if ($photo) {
                $coach_event->setPhoto($photo);
            }

            $this->dm->persist($coach_event);

            if ($request->request->get('dates'))
            {
                $dates          = array();
                parse_str($request->request->get('dates'), $dates);
                
                for ($i=0; $i<count($dates['date_event']); $i++)
                {
                    $date = new \DateTime($dates['date_event'][$i] . " " . $dates['time_event'][$i]);
                    
                    $eventDates = $this->dm->getRepository("CoachBundle:CoachEventDates")->findOneByDate($date);
                    if (!$eventDates instanceof CoachEventDates)
                    {
                        $coachEventDates = new CoachEventDates();
                        $coachEventDates->setDate($date);
                        $coachEventDates->setEvent($coach_event);
                        $this->dm->persist($coachEventDates);
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
    
    public function showEvent(Request $request, CoachInfo $coachInfo)
    {
        $id_coach_event  = $request->request->get('coach_event');

        if ( !$id_coach_event )
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "The field: Coach_event is required.",
                ),
                'result' => ""
            );
        } else if (
                    !Tools::isInt($id_coach_event) || 
                    !$coachEvent = $this->dm->getRepository("CoachBundle:CoachEvent")->findOneBy(array('id' => $id_coach_event, 'idCoach' => $coachInfo))
                )
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Invalid data for: Coach_event.",
                ),
                'result' => ""
            );
        }
        
        return $coachEvent;
    }
    
    public function deleteEvent(Request $request, CoachInfo $coachInfo)
    {
        $id_coach_event = $request->request->get('coach_event');
        $status         = $this->container->getParameter("status");

        if ( !$id_coach_event )
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "The field: Coach_event is required.",
                ),
                'result' => ""
            );
        } else if (
                    !Tools::isInt($id_coach_event) || 
                    !$coachEvent = $this->dm->getRepository("CoachBundle:CoachEvent")->findOneBy(array('id' => $id_coach_event, 'idCoach' => $coachInfo))
                )
        {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Invalid data for: Coach_event.",
                ),
                'result' => ""
            );
        }
        
        try
        {
            
            $coachEvent->setStatus($status['removed']);
            
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
