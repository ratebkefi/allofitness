<?php

namespace CoachBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcherInterface;
use CoachBundle\Entity\CoachInfo;

class ApiCoachController extends FOSRestController {

    /**
     * Crée un nouveau Coach à partir des données soumises.
     *
     * @ApiDoc(
     *     section="03. services de Coach",
     *   resource = true,
     *      parameters={
     *        {"name"="first_name", "dataType"="string", "required"=true, "description"="first_name"},
     *        {"name"="last_name", "dataType"="string", "required"=true, "description"="last_name"},
     *        {"name"="password", "dataType"="string", "required"=true, "description"="password"},
     *        {"name"="email", "dataType"="string", "required"=true, "description"="email"},
     *        {"name"="adress", "dataType"="string", "required"=true, "description"="adress"},
     *       {"name"="adresse_contunied", "dataType"="string", "required"=true, "description"="adresse_contunied"},
     *        {"name"="phone", "dataType"="string", "required"=true, "description"="phone"},
     *      {"name"="country", "dataType"="integer", "required"=true, "description"="country"},
     *     {"name"="region", "dataType"="integer", "required"=true, "description"="region"},
     *     {"name"="departement", "dataType"="integer", "required"=true, "description"="departement"},
     *     {"name"="city", "dataType"="integer", "required"=true, "description"="ville"},
     *     {"name"="cp", "dataType"="integer", "required"=true, "description"="roles"},
     *     {"name"="birth_date", "dataType"="string", "required"=true, "description"="birth_date"},
     *     {"name"="diploma", "dataType"="string", "required"=true, "description"="diploma"},
     *     {"name"="photo", "dataType"="string", "required"=true, "description"="photo"},
     *     {"name"="kbis", "dataType"="string", "required"=true, "description"="kbis"},
     *     {"name"="business_card", "dataType"="string", "required"=true, "description"="business_card"},
     *     {"name"="civility", "dataType"="integer", "required"=true, "description"="civility"},
     *     {"name"="rib", "dataType"="string", "required"=true, "description"="rib"},
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

    public function addCoachAction(Request $request)
    {

        $params = array(
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'adress'=> $request->get('adress'),
            'adresse_contunied'=> $request->get('adresse_contunied'),
            'phone'=> $request->get('phone'),
            'country'=> $request->get('country'),
            'region'=> $request->get('region'),
            'civility'=> $request->get('civility'),
            'departement'=> $request->get('departement'),
            'city'=> $request->get('city'),
            'cp'=> $request->get('cp'),
            'birth_date'=> $request->get('birth_date'),
            'diploma'=> $request->get('diploma'),
            'photo'=> $request->get('photo'),
            'kbis'=> $request->get('kbis'),
            'rib'=> $request->get('rib'),
            'business_card'=> $request->get('business_card'),
            'rib'=> $request->get('rib'),
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

        $coach       = $this->get('coach.manager')->registerCoach($params);

		$template    = 'CoachBundle:Email:registercoach.html.twig';
        $title       = $this->container->getParameter("sujet_inscript");
        $website     = $this->container->getParameter("website_titre");
        $url_activate= $coach['result']->getIdUser()->getConfirmationToken().'/activatcompte';

        $data=array(
            'name'        => $coach['result']->getFirstName().' '.$coach['result']->getLastName(),
            'username'    => $coach['result']->getIdUser()->getUsername(),
            'email'       => $coach['result']->getIdUser()->getEmail(),
            'password'    => $coach['result']->getIdUser()->getPlainPassword(),
            'civility'    => $coach['result']->getIdUser()->getCivility()->getName(),
            'url_activate'=> $url_activate,
            'website_url' => $this->container->getParameter("website_url"),
        );


       $this->get('mailing.manager')->SendMail($title,$website,$template,$data);

        return $coach;

    }

    /**
     * supprimer un Coach.
     *
     * @ApiDoc(
     *     section="03. services de Coach",
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

    public function deleteCoachAction(Request $request)
    {

    }

    /**
     * afficher liste des Coach.
     *
     * @ApiDoc(
     *     section="03. services de Coach",
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

    public function showCoachAction($id)
    {
        $coach= $this->getDoctrine()
            ->getRepository('CoachBundle:CoachInfo')
            ->find($id);
        return $coach;

    }

    /**
     * afficher liste des Coach.
     *
     * @ApiDoc(
     *     section="03. services de Coach",
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

    public function listCoachAction(Request $request)
    {


    }

    /**
     * filtre liste des Coach.
     *
     * @ApiDoc(
     *     section="03. services de Coach",
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

    public function filterCoachAction(Request $request)
    {
        $search_filter=$request->get('search_filter');

        $itemsPerPage=$request->get('item_per_page');
        $pagenumber=$request->get('page_number');

        $coach = $this->getDoctrine()
            ->getRepository('CoachBundle:CoachInfo')
            ->filterCoach($search_filter,$itemsPerPage, $pagenumber);

        return $coach;

    }

    /**
     * filtre liste des Coach.
     *
     * @ApiDoc(
     *     section="03. services de Coach",
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

    public function totalCoachAction(Request $request)
    {
        $search_filter=$request->get('search_filter');
        $coach = $this->getDoctrine()
            ->getRepository('CoachBundle:CoachInfo')
            ->TotalCoach($search_filter);

        return $coach;

    }

    /**
     * modifier etat des Coach.
     *
     * @ApiDoc(
     *
     *     section="03. services de Coach",
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
    public function statusCoachAction(Request $request)
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
        $coach        = $this->get('coach.manager')->statusCoach($status,$id);

        $template    ='CommunBundle:Email:status'.$status.'UserInfo.html.twig';
        $website     = $this->container->getParameter("website_titre");

        $data=array(
            'name'        => $coach['result']->getFirstName().' '.$coach['result']->getLastName(),
            'username'    => $coach['result']->getIdUser()->getUsername(),
            'email'       => $coach['result']->getIdUser()->getEmail(),
            'password'    => $coach['result']->getIdUser()->getPlainPassword(),
            'civility'    => $coach['result']->getIdUser()->getCivility()->getName(),
            'website_url' => $this->container->getParameter("website_url"),
            'email_admin' => $this->container->getParameter("email_admin"),
        );
        
        $this->get('mailing.manager')->SendMail($title,$website,$template,$data);

        return true;

    }

    /**
     * modifier un Coach.
     *
     * @ApiDoc(
     *     section="03. services de Coach",
     *      parameters={
     *      {"name"="id", "dataType"="string", "required"=true, "description"="id"},
     *        {"name"="first_name", "dataType"="string", "required"=true, "description"="first_name"},
     *        {"name"="last_name", "dataType"="string", "required"=true, "description"="last_name"},
     *        {"name"="password", "dataType"="string", "required"=true, "description"="password"},
     *        {"name"="email", "dataType"="string", "required"=true, "description"="email"},
     *        {"name"="adress", "dataType"="string", "required"=true, "description"="adress"},
     *       {"name"="adresse_contunied", "dataType"="string", "required"=true, "description"="adresse_contunied"},
     *        {"name"="phone", "dataType"="string", "required"=true, "description"="phone"},
     *      {"name"="country", "dataType"="integer", "required"=true, "description"="country"},
     *     {"name"="region", "dataType"="integer", "required"=true, "description"="region"},
     *     {"name"="departement", "dataType"="integer", "required"=true, "description"="departement"},
     *     {"name"="city", "dataType"="integer", "required"=true, "description"="ville"},
     *     {"name"="cp", "dataType"="integer", "required"=true, "description"="roles"},
     *     {"name"="birth_date", "dataType"="string", "required"=true, "description"="birth_date"},
     *     {"name"="diploma", "dataType"="string", "required"=true, "description"="diploma"},
     *     {"name"="photo", "dataType"="string", "required"=true, "description"="photo"},
     *     {"name"="kbis", "dataType"="string", "required"=true, "description"="kbis"},
     *     {"name"="business_card", "dataType"="string", "required"=true, "description"="business_card"},
     *     {"name"="rib", "dataType"="string", "required"=true, "description"="rib"},
     *     {"name"="civility", "dataType"="integer", "required"=true, "description"="civility"},
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

    public function updateCoachAction(Request $request)
    {

        $params = array(
            'id' => $request->get('id'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'adress'=> $request->get('adress'),
            'adresse_contunied'=> $request->get('adresse_contunied'),
            'phone'=> $request->get('phone'),
            'country'=> $request->get('country'),
            'region'=> $request->get('region'),
            'civility'=> $request->get('civility'),
            'departement'=> $request->get('departement'),
            'city'=> $request->get('city'),
            'cp'=> $request->get('cp'),
            'birth_date'=> $request->get('birth_date'),
            'diploma'=> $request->get('diploma'),
            'photo'=> $request->get('photo'),
            'kbis'=> $request->get('kbis'),
            'rib'=> $request->get('rib'),
            'business_card'=> $request->get('business_card'),
            'rib'=> $request->get('rib'),
        );


        $user = $this->get('coach.manager')->updateDetailsCoach($params);

        return $user;

    }

    /**
     * Liste des événements
     *
     * @ApiDoc(
     *   section="03. services de Coach",
     *   resource = true,
     *   parameters={
     *      {"name"="coach_info", "dataType"="string", "required"=true, "description"="Id coach info"},
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
        $coach_manager   = $this->get('coach.manager');
        $verifCoach     = $coach_manager->verifCoach($request);
        
        // validation du données
        if ($verifCoach !== true && is_array($verifCoach)) {
             return $verifCoach;
        }
        
        $validateStatus = $coach_manager->validateStatus($request);
        if ($validateStatus !== true && is_array($validateStatus)) {
             return $validateStatus;
        }
        
        $validateMonth = $coach_manager->validateMonth($request);
        if ($validateMonth !== true && is_array($validateMonth)) {
             return $validateMonth;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');
        $coachInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_COACH', $request->request->get("coach_info"));
        if (!$coachInfo instanceof CoachInfo) {
            return $coachInfo;
        }
        
        return $coach_manager->listEvents($request, $coachInfo);
    }
    
    /**
     * Ajout d'un événement
     *
     * @ApiDoc(
     *   section="03. services de Coach",
     *   resource = true,
     *   parameters={
     *      {"name"="coach_info", "dataType"="string", "required"=true, "description"="Id coach info"},
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
        $coach_manager      = $this->get('coach.manager');
        $validateDataEvent  = $coach_manager->validateDataEvent($request);
        
        // validation du données
        if ($validateDataEvent !== true && is_array($validateDataEvent)) {
             return $validateDataEvent;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');
        $coachInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_COACH', $request->request->get("coach_info"));
        if (!$coachInfo instanceof CoachInfo) {
            return $coachInfo;
        }
        
        return $coach_manager->addEvent($request, $coachInfo);
    }
    
    /**
     * Modification d'un événement
     *
     * @ApiDoc(
     *   section="03. services de Coach",
     *   resource = true,
     *   parameters={
     *      {"name"="coach_info", "dataType"="string", "required"=true, "description"="Id coach info"},
     *      {"name"="coach_event", "dataType"="integer", "required"=true, "description"="Id d'événement du coach"},
     *      {"name"="title", "dataType"="string", "required"=false, "description"="Titre d'événement"},
     *      {
                "name"="dates", 
                "dataType"="string", 
                "required"=false,
                "description"="Date(s) d'événement. Exemple: date_event[]=2016-01-01&time_event[]=00:00&date_event[]=2016-01-31&time_event[]=00:59 ..."
            },
     *      {"name"="description", "dataType"="string", "required"=false, "description"="Description d'évenément"},
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
        $coach_manager       = $this->get('coach.manager');
        $validateDataEvent  = $coach_manager->validateDataEventToUpdate($request);
        
        // validation du données
        if ($validateDataEvent !== true && is_array($validateDataEvent)) {
             return $validateDataEvent;
        }
        
        $validateStatus  = $coach_manager->validateStatus($request);
        if ($validateStatus !== true && is_array($validateStatus)) {
             return $validateStatus;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');
        $coachInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_COACH', $request->request->get("coach_info"));
        if (!$coachInfo instanceof CoachInfo) {
            return $coachInfo;
        }
        
        return $coach_manager->updateEvent($request, $coachInfo);
    }
    
    /**
     * Détails d'un événement
     *
     * @ApiDoc(
     *   section="03. services de Coach",
     *   resource = true,
     *   parameters={
     *      {"name"="coach_info", "dataType"="integer", "required"=true, "description"="Id coach info"},
     *      {"name"="coach_event", "dataType"="integer", "required"=true, "description"="Id d'événement du coach"}
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
        $coach_manager  = $this->get('coach.manager');
        $verifCoach     = $coach_manager->verifCoach($request);
        
        // validation du données
        if ($verifCoach !== true && is_array($verifCoach)) {
             return $verifCoach;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');
        $coachInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_COACH', $request->request->get("coach_info"));
        if (!$coachInfo instanceof CoachInfo) {
            return $coachInfo;
        }
        
        return $coach_manager->showEvent($request, $coachInfo);
    }
    
    /**
     * Suppression d'un événement
     *
     * @ApiDoc(
     *   section="03. services de Coach",
     *   resource = true,
     *   parameters={
     *      {"name"="coach_info", "dataType"="integer", "required"=true, "description"="Id coach info"},
     *      {"name"="coach_event", "dataType"="integer", "required"=true, "description"="Id d'événement du coach"}
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
        $coach_manager  = $this->get('coach.manager');
        $verifCoach     = $coach_manager->verifCoach($request);
        
        // validation du données
        if ($verifCoach !== true && is_array($verifCoach)) {
             return $verifCoach;
        }
        
        // verif auth & role
        $user_manager           = $this->get('user.manager');
        $coachInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_COACH', $request->request->get("coach_info"));
        if (!$coachInfo instanceof CoachInfo) {
            return $coachInfo;
        }
        
        return $coach_manager->deleteEvent($request, $coachInfo);
    }




}
