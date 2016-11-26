<?php

namespace ClubBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcherInterface;
use ClubBundle\Entity\ClubInfo;

class ApiClubTeamController extends FOSRestController 
{



    
    /**
     * Listing d'équipe d'un club
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="string", "required"=true, "description"="Id club info"},
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
    public function listClubTeamAction(Request $request)
    {
        $club_manager   	= $this->get('club.manager');
		$club_team_manager  = $this->get('club_team.manager');
        $verifClub      	= $club_manager->verifClub($request);
        
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
        		
		 return $club_team_manager->listClubTeam( $clubInfo);
    }
    
    /**
     * Ajout membre d'equipe
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="string", "required"=true, "description"="Id club info"},
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="Nom"},
     *      {"name"="prenom", "dataType"="string", "required"=true, "description"="Prénom"},
     *      {"name"="function", "dataType"="string", "required"=true, "description"="Fonction"},	 
     *      {"name"="photo", "dataType"="string", "required"=false, "description"="Photo"}
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
    public function addClubTeamAction(Request $request)
    {
        $club_manager       = $this->get('club_team.manager');
        $validateDataEvent  = $club_manager->validateDataAddClubTeam($request);
        
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
        
        return $club_manager->addClubTeam($request, $clubInfo);
    }
    
    /**
     * Modification membre d'equipe
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="string", "required"=true, "description"="Id club info"},
     *      {"name"="club_team", "dataType"="string", "required"=true, "description"="Id Team"},
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="Nom"},
     *      {"name"="prenom", "dataType"="string", "required"=true, "description"="Prénom"},
     *      {"name"="function", "dataType"="string", "required"=true, "description"="Fonction"},	 
     *      {"name"="photo", "dataType"="string", "required"=false, "description"="Photo"}
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
    public function updateClubTeamAction(Request $request)
    {
        $club_manager       = $this->get('club.manager');
		$club_team_manager  = $this->get('club_team.manager');
        $validateDataEvent  = $club_team_manager->validateDataUpdateClubTeam($request);
        
        // validation du données
        if ($validateDataEvent !== true && is_array($validateDataEvent)) {
             return $validateDataEvent;
        }
        /*
        $validateStatus = $club_manager->validateStatus($request);
        if ($validateStatus !== true && is_array($validateStatus)) {
             return $validateStatus;
        }
        */
        // verif auth & role
        $user_manager           = $this->get('user.manager');
        $clubInfo = $user_manager->verifClubOrCoachOrMemberByUserRole('ROLE_CLUB', $request->request->get("club_info"));
        if (!$clubInfo instanceof ClubInfo) {
            return $clubInfo;
        }
        
        return $club_team_manager->updateClubTeam($request, $clubInfo);
    }
	
    /**
     * Suppression d'un membre de l'equipe
     *
     * @ApiDoc(
     *   section="02. services de Club",
     *   resource = true,
     *   parameters={
     *      {"name"="club_info", "dataType"="integer", "required"=true, "description"="Id club info"},
     *      {"name"="club_team", "dataType"="integer", "required"=true, "description"="Id Team"}
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
    public function deleteClubTeamAction(Request $request)
    {
        $club_manager   	= $this->get('club.manager');
		$club_team_manager  = $this->get('club_team.manager');
        $verifClub      	= $club_manager->verifClub($request);
        
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
        	
        return $club_team_manager->deleteClubTeam($request, $clubInfo);
    }
    
}
