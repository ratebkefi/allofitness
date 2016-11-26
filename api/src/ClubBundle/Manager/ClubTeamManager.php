<?php

namespace ClubBundle\Manager;

use ClubBundle\Entity\ClubInfo;
use ClubBundle\Entity\ClubTeam;
use Doctrine\ORM\EntityManager;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use LogicException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use CommunBundle\Tools\Tools;


/**
 * Manager for frontend ClubTeamManager.
 *
 * @author atef abdellaoui
 */
class ClubTeamManager
{

    /**
     * @var EntityManager
     */
    protected $dm;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     *
     * @param EntityManager $entityManager
     * @param ContainerInterface $container
     */
    public function __construct(
        EntityManager $entityManager,
        ContainerInterface $container
    )
    {
        $this->dm = $entityManager;
        $this->container = $container;
    }

    public function listClubTeam(ClubInfo $clubInfo)
    {
		$clubTeams = $this->findClubTeamBy(array('idClub' => $clubInfo), false);
		
        $outpout = array();
        
        foreach ($clubTeams as $clubTeam)
        {		
            $outpout[] = array(
                'nom' 		=> $clubTeam->getLastName(),
                'prenom'  	=> $clubTeam->getFirstName(),
                'function' 	=> $clubTeam->getFunction(),
                'photo' 	=> ($clubTeam->getPhoto()) ? $clubTeam->getPhoto() : ''
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

	
    public function validateDataAddClubTeam($request)
    {		
        $attrs          = array( 'club_info', 'nom', 'prenom', 'function' );
        $require_attrs  = '';
        $invalid_data   = '';
        $status         = $this->container->getParameter("status");
        	
		$mClub = $this->container->get('club.manager');
		
        foreach ($attrs as $attr)
        {
            switch ($attr)
            {
                case 'club_info':
                    $id_club_info = $request->get("club_info");
                    if ( !$id_club_info )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $club_info = $mClub->findClubInfoBy(array("id" => $id_club_info, "status" => $status["activate"]));
						
                        // verif ClubInfo is exist & activate by id
                        if ( !($club_info instanceof ClubInfo) ) // not valid
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
                case 'nom':
                case 'prenom':
                case 'function':
                    if (!$request->get($attr))
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
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
	
   public function validateDataUpdateClubTeam($request)
    {
        $attrs          = array( 'club_info', 'club_team' ,'nom', 'prenom', 'function' );
        $require_attrs  = '';
        $invalid_data   = '';
        $status         = $this->container->getParameter("status");
        $mClub          = $this->container->get('club.manager');
		
        foreach ($attrs as $attr)
        {
            switch ($attr)
            {
                case 'club_info':
                    $id_club_info = $request->get("club_info");
                    if ( !$id_club_info )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } else
                    {
                        $club_info = $mClub->findClubInfoBy(array("id" => $id_club_info, "status" => $status["activate"]));
                        // verif ClubInfo is exist & activate by id
                        if ( !($club_info instanceof ClubInfo) ) // not valid
                        {
                            $invalid_data .= ($invalid_data) ? ', ' : '';
                            $invalid_data .= ucfirst($attr);
                        }
                    }
                    break;
                case 'club_team':
                    $id_club_team = $request->get("club_team");
                    if ( !$id_club_team )
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
                    } 
                    break;
                case 'nom':
                case 'prenom':
                case 'function':
                    if (!$request->get($attr))
                    {
                        $require_attrs .= ($require_attrs) ? ', ' : '';
                        $require_attrs .= ucfirst($attr);
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
	
	
    public function addClubTeam($request, ClubInfo $clubInfo)
    {
        try
        {
            $clubTeam = new ClubTeam();
            $clubTeam->setIdClub($clubInfo);
			
			$clubTeam->setLastName($request->get('nom'));
			$clubTeam->setFirstName($request->get('prenom'));
			$clubTeam->setPhoto($request->get('photo'));
			$clubTeam->setFunction($request->get('function'));			
			$clubTeam->setStatus(0);

            $this->dm->persist($clubTeam);          
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
	
  public function updateClubTeam($request, ClubInfo $clubInfo)
    {
        
        $id_club_team  = $request->get('club_team');
        $club_team     = $this->findClubTeamBy(array("id" => $id_club_team));
		
        if ($club_team->getIdClub()->getId() != $clubInfo->getId())
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "Invalid data for: club_team.",
                ),
                'result' => ""
            );
        }
        
        try
        {
			$club_team->setLastName($request->get('nom'));
			$club_team->setFirstName($request->get('prenom'));
			$club_team->setPhoto($request->get('photo'));
			$club_team->setFunction($request->get('function'));						
            
            $this->dm->persist($club_team);    
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
    	
   public function deleteClubTeam($request, ClubInfo $clubInfo)
    {
        $id_club_team  = $request->get('club_team');
        $club_team     = $this->findClubTeamBy(array("id" => $id_club_team));
				
        if ($club_team->getIdClub()->getId() != $clubInfo->getId() OR !$club_team)
        {
            return array(
                'message' => array(
                    'code' => "400",
                    'text' => "Invalid data for: club_team.",
                ),
                'result' => ""
            );
        }		
	
        try
        {
            $this->dm->remove($club_team);
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
		
		
	
    public function findClubTeamBy(array $args, $one=true)
    {
        if ($one)
        {
            return  $this->dm
                    ->getRepository("ClubBundle:ClubTeam")
                    ->findOneBy($args);
        }
        return  $this->dm
                ->getRepository("ClubBundle:ClubTeam")
                ->findBy($args);
    }	
	
	
	
	
 
}
