<?php

namespace ClubBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcherInterface;
use ClubBundle\Entity\ClubInfo;

class ApiClubController extends FOSRestController 
{
    /**
     * Crée un nouveau Club à partir des données soumises.
     *
     * @ApiDoc(
     *     section="02. services de Club",
     *   resource = true,
     *      parameters={
     *        {"name"="club_name", "dataType"="string", "required"=true, "description"="club_name"},
     *        {"name"="club_network", "dataType"="integer", "required"=true, "description"="club_network"},
     *        {"name"="club_type", "dataType"="integer", "required"=true, "description"="club_type"},
     *        {"name"="adress", "dataType"="string", "required"=true, "description"="adress"},
     *        {"name"="adresse_contunied", "dataType"="string", "required"=true, "description"="adresse_contunied"},
     *      {"name"="country", "dataType"="integer", "required"=true, "description"="country"},
     *     {"name"="region", "dataType"="integer", "required"=true, "description"="region"},
     *     {"name"="departement", "dataType"="integer", "required"=true, "description"="departement"},
     *     {"name"="city", "dataType"="integer", "required"=true, "description"="ville"},
     *     {"name"="cp", "dataType"="integer", "required"=true, "description"="roles"},
     *     {"name"="phone", "dataType"="string", "required"=true, "description"="phone"},
     *     {"name"="cellphone", "dataType"="string", "required"=true, "description"="cellphone"},
     *     {"name"="url_site", "dataType"="string", "required"=true, "description"="url_site"},
     *     {"name"="first_name_responsible", "dataType"="string", "required"=true, "description"="first_name_responsible"},
     *     {"name"="last_name_responsible", "dataType"="string", "required"=true, "description"="last_name_responsible"},
     *     {"name"="responsible_function", "dataType"="string", "required"=true, "description"="responsible_function"},
     *     {"name"="email_of_the_person_contacted", "dataType"="string", "required"=true, "description"="email_of_the_person_contacted"},
     *     {"name"="email_of_the_person_contacted_cc", "dataType"="string", "required"=true, "description"="email_of_the_person_contacted_cc"},
     *     {"name"="password", "dataType"="string", "required"=true, "description"="password"},
     *     {"name"="email", "dataType"="string", "required"=true, "description"="email"},
     *     {"name"="civility", "dataType"="integer", "required"=true, "description"="civility"},
     *     {"name"="superficie", "dataType"="integer", "required"=true, "description"="superficie"},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param Request $request the request object
     *
     * @return String
     */

    public function addClubAction(Request $request)
    {

        $params = array(
            'club_name' => $request->get('club_name'),
            'club_network' => $request->get('club_network'),
            'club_type' => $request->get('club_type'),
            'adress'=> $request->get('adress'),
            'adresse_contunied'=> $request->get('adresse_contunied'),
            'country'=> $request->get('country'),
            'region'=> $request->get('region'),
            'departement'=> $request->get('departement'),
            'city'=> $request->get('city'),
            'cp'=> $request->get('cp'),
            'phone'=> $request->get('phone'),
            'cellphone'=> $request->get('cellphone'),
            'url_site'=> $request->get('url_site'),
            'superficie'=> $request->get('superficie'),
            'civility'=> $request->get('civility'),
            'first_name_responsible'=> $request->get('first_name_responsible'),
            'last_name_responsible'=> $request->get('last_name_responsible'),
            'responsible_function'=> $request->get('responsible_function'),
            'email_of_the_person_contacted'=> $request->get('email_of_the_person_contacted'),
            'email_of_the_person_contacted_cc'=> $request->get('email_of_the_person_contacted_cc'),
            'password'=> $request->get('password'),
            'email'=> $request->get('email'),
        );

        if ($this->get('user.manager')->findUser($params['email'], $params['email'])) {
            return array(
                'message' => array(
                    'code' => "500",
                    'text' => "Nom d'utilisateur déjà pris!",
                ),
                'result' => ""
            );
        }
        if ($this->get('user.manager')->findUserByEmailTest( $params['email'])) {
            return array(
                'message' => array(
                    'code' => "501",
                    'text' => "Nom d'utilisateur déjà pris!",
                ),
                'result' => ""
            );
        }
		
        $club        = $this->get('club.manager')->registerClub($params);

        $template    ='ClubBundle:Email:registerclub.html.twig';
        $title       = $this->container->getParameter("sujet_inscript");
        $website     = $this->container->getParameter("website_titre");
        $url_activate= $club['result']->getIdUser()->getConfirmationToken().'/activatcompte';

        $data=array(
            'name' => $club['result']->getFirstNameResponsible(),
            'username' => $club['result']->getIdUser()->getUsername(),
			'email' => $club['result']->getIdUser()->getEmail(),
            'password' => $club['result']->getIdUser()->getPlainPassword(),
            'civility' => $club['result']->getIdUser()->getCivility()->getName(),
            'url_activate'=> $url_activate,
            'website_url' => $this->container->getParameter("website_url"),
        );
		
		$this->get('mailing.manager')->SendMail($title,$website,$template,$data);

        return $club;
    }

    /**
     * supprimer un Club.
     *
     * @ApiDoc(
     *     section="02. services de Club",
     *   resource = true,
     *      parameters={
     *        {"name"="username", "dataType"="string", "required"=true, "description"="username"},
     *        {"name"="password", "dataType"="string", "required"=true, "description"="password"},
     *        {"name"="email", "dataType"="string", "required"=true, "description"="email"},
     *        {"name"="enabled", "dataType"="boolean", "required"=true, "description"="enabled"},
     *        {"name"="roles", "dataType"="string", "required"=true, "description"="roles"},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param Request $request the request object
     *
     * @return String
     */
    public function deleteClubAction(Request $request)
    {


    }



    /**
     * filterClub liste des Club.
     *
     * @ApiDoc(
     *     section="02. services de Club",
     *   resource = true,
     *      parameters={
     *         {"name"="search_filter", "dataType"="string", "required"=true, "description"="Critere de recherche"},
     *         {"name"="item_per_page", "dataType"="string", "required"=true, "description"="item par page"},
     *        {"name"="page_number", "dataType"="string", "required"=true, "description"="nombre du page"},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param Request $request the request object
     *
     * @return String
     */
    public function filterClubAction(Request $request)
    {
        $search_filter=$request->get('search_filter');
        $itemsPerPage=$request->get('item_per_page');
        $pagenumber=$request->get('page_number');


        $club = $this->getDoctrine()
            ->getRepository('ClubBundle:ClubInfo')
            ->filterClub($search_filter,$itemsPerPage, $pagenumber);

        return $club;

    }

    /**
     * afficher liste des Club.
     *
     * @ApiDoc(
     *     section="02. services de Club",
     *   resource = true,
     *      parameters={
     *        {"name"="username", "dataType"="string", "required"=true, "description"="username"},
     *        {"name"="password", "dataType"="string", "required"=true, "description"="password"},
     *        {"name"="email", "dataType"="string", "required"=true, "description"="email"},
     *        {"name"="enabled", "dataType"="boolean", "required"=true, "description"="enabled"},
     *        {"name"="roles", "dataType"="string", "required"=true, "description"="roles"},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param Request $request the request object
     *
     * @return String
     */
    public function listClubAction(Request $request)
    {


    }


    /**
     * afficher un Club.
     *
     * @ApiDoc(
     *     section="02. services de Club",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param Request $request the request object
     *
     * @return String
     */
    public function showClubAction($id)
    {

        $club= $this->getDoctrine()
            ->getRepository('ClubBundle:ClubInfo')
            ->find($id);
        return $club;

    }


    /**
     * modifier un Club.
     *
     * @ApiDoc(
     *     section="02. services de Club",
     *   resource = true,
     *      parameters={
     *     {"name"="id", "dataType"="integer", "required"=true, "description"="id club"},
     *        {"name"="club_name", "dataType"="string", "required"=true, "description"="club_name"},
     *        {"name"="club_network", "dataType"="integer", "required"=true, "description"="club_network"},
     *        {"name"="club_type", "dataType"="integer", "required"=true, "description"="club_type"},
     *        {"name"="adress", "dataType"="string", "required"=true, "description"="adress"},
     *        {"name"="adresse_contunied", "dataType"="string", "required"=true, "description"="adresse_contunied"},
     *      {"name"="country", "dataType"="integer", "required"=true, "description"="country"},
     *     {"name"="region", "dataType"="integer", "required"=true, "description"="region"},
     *     {"name"="departement", "dataType"="integer", "required"=true, "description"="departement"},
     *     {"name"="city", "dataType"="integer", "required"=true, "description"="ville"},
     *     {"name"="cp", "dataType"="integer", "required"=true, "description"="roles"},
     *     {"name"="phone", "dataType"="string", "required"=true, "description"="phone"},
     *     {"name"="cellphone", "dataType"="string", "required"=true, "description"="cellphone"},
     *     {"name"="url_site", "dataType"="string", "required"=true, "description"="url_site"},
     *     {"name"="first_name_responsible", "dataType"="string", "required"=true, "description"="first_name_responsible"},
     *     {"name"="last_name_responsible", "dataType"="string", "required"=true, "description"="last_name_responsible"},
     *     {"name"="responsible_function", "dataType"="string", "required"=true, "description"="responsible_function"},
     *     {"name"="email_of_the_person_contacted", "dataType"="string", "required"=true, "description"="email_of_the_person_contacted"},
     *     {"name"="email_of_the_person_contacted_cc", "dataType"="string", "required"=true, "description"="email_of_the_person_contacted_cc"},
     *     {"name"="password", "dataType"="string", "required"=true, "description"="password"},
     *     {"name"="email", "dataType"="string", "required"=true, "description"="email"},
     *     {"name"="civility", "dataType"="integer", "required"=true, "description"="civility"},
     *     {"name"="superficie", "dataType"="integer", "required"=true, "description"="superficie"},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param Request $request the request object
     *
     * @return String
     */
    public function updateClubAction(Request $request)
    {
        $params = array(
            'id' => $request->get('id'),
            'club_name' => $request->get('club_name'),
            'club_network' => $request->get('club_network'),
            'club_type' => $request->get('club_type'),
            'adress'=> $request->get('adress'),
            'adresse_contunied'=> $request->get('adresse_contunied'),
            'country'=> $request->get('country'),
            'region'=> $request->get('region'),
            'departement'=> $request->get('departement'),
            'civility'=> $request->get('civility'),
            'city'=> $request->get('city'),
            'cp'=> $request->get('cp'),
            'phone'=> $request->get('phone'),
            'cellphone'=> $request->get('cellphone'),
            'url_site'=> $request->get('url_site'),
            'superficie'=> $request->get('superficie'),
            'first_name_responsible'=> $request->get('first_name_responsible'),
            'last_name_responsible'=> $request->get('last_name_responsible'),
            'responsible_function'=> $request->get('responsible_function'),
            'email_of_the_person_contacted'=> $request->get('email_of_the_person_contacted'),
            'email_of_the_person_contacted_cc'=> $request->get('email_of_the_person_contacted_cc'),
            'password'=> $request->get('password'),
            'email'=> $request->get('email'),
        );


        $user = $this->get('club.manager')->updateDetailsClub($params);

        return $user;

    }
    
    /**
     * Activités / Equipements / Confort / Services +
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="string", "required"=true, "description"="Id club info"},
     *      {"name"="address", "dataType"="string", "required"=true, "description"="Address"},
     *      {"name"="latitude", "dataType"="string", "required"=true, "description"="Latitude"},
     *      {"name"="longitude", "dataType"="string", "required"=true, "description"="Longitude"},
     *      {
     *          "name"="activities", 
     *          "dataType"="string", 
     *          "required"=true, 
     *          "format"="{""2"":""3|7|8..."", ""5"":""4|9|3..."", ...}", 
     *          "description"="Activities"
     *      },
     *      {"name"="course_schedule", "dataType"="string", "required"=false, "description"="Course Schedule"},
     *      {"name"="equipements", "dataType"="string", "required"=true, "format"="[1,2,8,12,14, ...]", "description"="Equipements"},
     *      {"name"="confort", "dataType"="string", "required"=true, "format"="[1,2,8,12,14, ...]", "description"="Confort"},
     *      {"name"="services", "dataType"="string", "required"=true, "format"="[1,2,8,12,14, ...]", "description"="Services"},
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * 
     * @param Request $request the request object
     *
     * @return String
     */
    public function activitesAndEquipementsAndConfortAndServicesAction(Request $request)
    {
        $club_manager           = $this->get('club.manager');
        $validate_data  = $club_manager->validateDataActivitesAndEquipementsAndConfortAndServices($request);
        
        // validation du données
        if ($validate_data !== true && is_array($validate_data)) {
             return $validate_data;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');        
        $clubInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_CLUB', $request->request->get("club_info"));
        if (!$clubInfo instanceof ClubInfo) {
            return $clubInfo;
        }
        
        return $club_manager->addClubActivitiesAmenitiesConfortServices($request, $clubInfo);
    }
    
    /**
     * Horaires / Accès
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="string", "required"=true, "description"="Id club info"},
     *      {"name"="time_opening_am", "dataType"="string", "required"=true, "format"="hh:mm", "description"="Temps ouverture AM"},
     *      {"name"="time_closing_am", "dataType"="string", "required"=true, "format"="hh:mm", "description"="Temps de fermeture AM"},
     *      {"name"="time_opening_pm", "dataType"="string", "required"=true, "format"="hh:mm", "description"="Temps ouverture PM"},
     *      {"name"="time_closing_pm", "dataType"="string", "required"=true, "format"="hh:mm", "description"="Temps de fermeture PM"},
     *      {
               "name"="days", 
               "dataType"="string", 
               "required"=true, 
               "format"="[""lundi"", ""mardi"", ..., ""dimanche""]", 
               "description"="Les jours d'ouverture sont : ""lundi"", ""mardi"", ""mercredi"", ""jeudi"", ""vendredi"", ""samedi"", ""dimanche""."
     *      },
     *      {
               "name"="access", 
               "dataType"="string", 
               "required"=true, 
               "format"="{""metro"":""description"", ""rer"":""description"", ..., ""autres"":""description""}", 
               "description"="Les accès sont : ""metro"", ""rer"", ""tramway"", ""bus"", ""borne_velo"", ""parking"", ""acces_routier_a_proximite"", ""autres""."
     *      }
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * 
     * @param Request $request the request object
     *
     * @return String
     */
    public function schedulesAndAccessAction(Request $request)
    {
        $club_manager           = $this->get('club.manager');
        
        // validation du données
        $validateDataSchedules  = $club_manager->validateDataSchedules($request);
        if ($validateDataSchedules !== true)
        {
            return $validateDataSchedules;
        }
        
        $validateDataAccess  = $club_manager->validateDataAccess($request);
        if ($validateDataAccess !== true)
        {
            return $validateDataAccess;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');        
        $clubInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_CLUB', $request->request->get("club_info"));
        if (!$clubInfo instanceof ClubInfo) {
            return $clubInfo;
        }
        
        return $club_manager->addDataSchedulesAndAccess($request, $clubInfo);
    }
    
    /**
     * filtre liste des Club.
     *
     * @ApiDoc(
     *     section="02. services de Club",
     *   resource = true,
     *      parameters={
     *         {"name"="search_filter", "dataType"="string", "required"=true, "description"="Critere de recherche"},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param Request $request the request object
     *
     * @return String
     */

    public function totalClubAction(Request $request)
    {
        $search_filter=$request->get('search_filter');
        $club = $this->getDoctrine()
            ->getRepository('ClubBundle:ClubInfo')
            ->TotalClub($search_filter);
        return $club;

    }

    /**
     * modifier etat des Club.
     *
     * @ApiDoc(
     *
     *     section="02. services de Club",
     *   resource = true,
     *      parameters={
     *        {"name"="status", "dataType"="integer", "required"=true, "description"="status"},
     *        {"name"="id", "dataType"="integer", "required"=true, "description"="id"},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param Request $request the request object
     *
     * @return String
     */
    public function statusClubAction(Request $request)
    {
        $status=$request->get('status');

        if($status==1)
        {
            $title       = 'Validation de votre compte';
        }
        else
        {
            $title       = 'Désactivation de votre compte';
        }

        $id=$request->get('id');
        $club        = $this->get('club.manager')->statusClub($status,$id);
        $template    = 'CommunBundle:Email:status'.$status.'UserInfo.html.twig';;
        $website     = $this->container->getParameter("website_titre");

        $data=array(
            'name'        => $club['result']->getFirstNameResponsible(),
            'username'    => $club['result']->getIdUser()->getUsername(),
            'email'       => $club['result']->getIdUser()->getEmail(),
            'password'    => $club['result']->getIdUser()->getPlainPassword(),
            'civility' 	  => $club['result']->getIdUser()->getCivility()->getName(),
            'website_url' => $this->container->getParameter("website_url"),
            'email_admin' => $this->container->getParameter("email_admin"),
        );

        $this->get('mailing.manager')->SendMail($title,$website,$template,$data);

        return true;
    }

    /**
     * Présentation
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="string", "required"=true, "description"="Id club info"},
     *      {"name"="introduction", "dataType"="string", "required"=false, "description"="Introduction"},
     *      {"name"="developpe", "dataType"="string", "required"=false, "description"="Développé"},
     *      {"name"="conclusion", "dataType"="string", "required"=false, "description"="Conclusion"},
     *      {"name"="mot_responsable_club", "dataType"="string", "required"=false, "description"="Le mot du responsable du club."}
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * 
     * @param Request $request the request object
     *
     * @return String
     */
    public function presentationAction(Request $request)
    {
        $club_manager           = $this->get('club.manager');
        $validateDataPresentation = $club_manager->validateDataPresentation($request);
        
        // validation du données
        if ($validateDataPresentation !== true && is_array($validateDataPresentation)) {
             return $validateDataPresentation;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');        
        $clubInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_CLUB', $request->request->get("club_info"));
        if (!$clubInfo instanceof ClubInfo) {
            return $clubInfo;
        }
        
        return $club_manager->addDataPresentation($request, $clubInfo);
    }
    
    /**
     * Invitation / Pass découverte
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="string", "required"=true, "description"="Id club info"},
     *      {"name"="invitation", "dataType"="integer", "required"=false, "description"="Invitation"}
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * 
     * @param Request $request the request object
     *
     * @return String
     */
    public function invitationAndDiscoveryPassAction(Request $request)
    {
        $club_manager           = $this->get('club.manager');
        $validateDataInvitation = $club_manager->validateDataInvitation($request);
        
        // validation du données
        if ($validateDataInvitation !== true && is_array($validateDataInvitation)) {
             return $validateDataInvitation;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');
        $clubInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_CLUB', $request->request->get("club_info"));
        if (!$clubInfo instanceof ClubInfo) {
            return $clubInfo;
        }
        
        return $club_manager->addDataInvitation($request, $clubInfo);
    }
    
    /**
     * Liste des événements d'un club
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="string", "required"=true, "description"="Id club info"},
     *      {"name"="status", "dataType"="string", "required"=false, "format"="[0, 1, ...]", "description"="Status d'événement : 0=En Attente d'activation, 1=Activer, 6=Supprimer, 7=Désactiver"},
     *      {"name"="month", "dataType"="string", "required"=false, "format"="mm-yyyy", "description"="Mois d'événement"},
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * 
     * @param Request $request the request object
     *
     * @return String
     */
    public function listEventsAction(Request $request)
    {
        $club_manager   = $this->get('club.manager');
        $verifClub      = $club_manager->verifClub($request);
        
        // validation du données
        if ($verifClub !== true && is_array($verifClub)) {
             return $verifClub;
        }
        
        $validateStatus = $club_manager->validateStatus($request);
        if ($validateStatus !== true && is_array($validateStatus)) {
             return $validateStatus;
        }
        
        $validateMonth = $club_manager->validateMonth($request);
        if ($validateMonth !== true && is_array($validateMonth)) {
             return $validateMonth;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');
        $clubInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_CLUB', $request->request->get("club_info"));
        if (!$clubInfo instanceof ClubInfo) {
            return $clubInfo;
        }
        
        return $club_manager->listEvents($request, $clubInfo);
    }
    
    /**
     * Ajout d'un événement d'un club
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="string", "required"=true, "description"="Id club info"},
     *      {"name"="title", "dataType"="string", "required"=true, "description"="Titre d'événement"},
     *      {
                "name"="dates", 
                "dataType"="string", 
                "required"=true,
                "description"="Date(s) d'événement. Exemple: date_event[]=2016-01-01&time_event[]=00:00&date_event[]=2016-01-31&time_event[]=00:59 ..."
            },
     *      {"name"="description", "dataType"="string", "required"=true, "description"="Description d'évenément"},
     *      {"name"="photo", "dataType"="string", "required"=false, "description"="Photo d'évenément"}
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * 
     * @param Request $request the request object
     *
     * @return String
     */
    public function addEventAction(Request $request)
    {
        $club_manager       = $this->get('club.manager');
        $validateDataEvent  = $club_manager->validateDataEvent($request);
        
        // validation du données
        if ($validateDataEvent !== true && is_array($validateDataEvent)) {
             return $validateDataEvent;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');
        $clubInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_CLUB', $request->request->get("club_info"));
        if (!$clubInfo instanceof ClubInfo) {
            return $clubInfo;
        }
        
        return $club_manager->addEvent($request, $clubInfo);
    }
    
    /**
     * Modification d'un événement d'un club
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="string", "required"=true, "description"="Id club info"},
     *      {"name"="club_event", "dataType"="integer", "required"=true, "description"="Id d'événement du club"},
     *      {"name"="title", "dataType"="string", "required"=true, "description"="Titre d'événement"},
     *      {
                "name"="dates", 
                "dataType"="string", 
                "required"=true,
                "description"="Date(s) d'événement. Exemple: date_event[]=2016-01-01&time_event[]=00:00&date_event[]=2016-01-31&time_event[]=00:59 ..."
            },
     *      {"name"="description", "dataType"="string", "required"=true, "description"="Description d'évenément"},
     *      {"name"="photo", "dataType"="string", "required"=false, "description"="Photo d'évenément"},
     *      {"name"="status", "dataType"="string", "required"=false, "format"="[0, 1, ...]", "description"="Status d'événement : 0=En Attente d'activation, 1=Activer, 6=Supprimer, 7=Désactiver"},
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * 
     * @param Request $request the request object
     *
     * @return String
     */
    public function updateEventAction(Request $request)
    {
        $club_manager       = $this->get('club.manager');
        $validateDataEvent  = $club_manager->validateDataEventToUpdate($request);
        
        // validation du données
        if ($validateDataEvent !== true && is_array($validateDataEvent)) {
             return $validateDataEvent;
        }
        
        $validateStatus = $club_manager->validateStatus($request);
        if ($validateStatus !== true && is_array($validateStatus)) {
             return $validateStatus;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');
        $clubInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_CLUB', $request->request->get("club_info"));
        if (!$clubInfo instanceof ClubInfo) {
            return $clubInfo;
        }
        
        return $club_manager->updateEvent($request, $clubInfo);
    }
    
    /**
     * Détails d'un événement d'un club
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="integer", "required"=true, "description"="Id club info"},
     *      {"name"="club_event", "dataType"="integer", "required"=true, "description"="Id d'événement du club"}
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * 
     * @param Request $request the request object
     *
     * @return String
     */
    public function showEventAction(Request $request)
    {
        $club_manager   = $this->get('club.manager');
        $verifClub      = $club_manager->verifClub($request);
        
        // validation du données
        if ($verifClub !== true && is_array($verifClub)) {
             return $verifClub;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');
        $clubInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_CLUB', $request->request->get("club_info"));
        if (!$clubInfo instanceof ClubInfo) {
            return $clubInfo;
        }
        
        return $club_manager->showEvent($request, $clubInfo);
    }
    
    /**
     * Suppression d'un événement d'un club
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="integer", "required"=true, "description"="Id club info"},
     *      {"name"="club_event", "dataType"="integer", "required"=true, "description"="Id d'événement du club"}
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * 
     * @param Request $request the request object
     *
     * @return String
     */
    public function deleteEventAction(Request $request)
    {
        $club_manager   = $this->get('club.manager');
        $verifClub      = $club_manager->verifClub($request);
        
        // validation du données
        if ($verifClub !== true && is_array($verifClub)) {
             return $verifClub;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');
        $clubInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_CLUB', $request->request->get("club_info"));
        if (!$clubInfo instanceof ClubInfo) {
            return $clubInfo;
        }
        
        return $club_manager->deleteEvent($request, $clubInfo);
    }
    
    
}
