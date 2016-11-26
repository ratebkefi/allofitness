<?php

/*
 * Manager for frontend users.
 * This file is part of the Admin package.
 *
 * (c) Atef Abdellaoui
 *
 */

namespace MemberBundle\Manager;

use CommunBundle\Entity\Adress;
use MemberBundle\Entity\MemberInfo;
use Doctrine\ORM\EntityManager;
use UserBundle\Manager\UserManager;
use LogicException;
use Symfony\Component\DependencyInjection\ContainerInterface;
//use CommunBundle\Tools\Tools;

class MemberManager
{
    /**
     * @var EntityManager
     */
    protected $dm;
  
    /**
     * @var UserManager
     */
    protected $userManager;
    
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * 
     * @param EntityManager $entityManager
     * @param UserManager $userManager
     * @param ContainerInterface $container
     */
    public function __construct(
        EntityManager       $entityManager,
        UserManager         $userManager,
        ContainerInterface  $container
    )
    {
        $this->dm           = $entityManager;
        $this->userManager  = $userManager;
        $this->container    = $container;
    }
    

    /**
     * Register user and send userinfo by email
     */
    public function registerMember($rqst)
    {


        try{
            
            $user = $this->userManager
                    ->registerUser(array('username'=> $rqst->get("email"), 'email'=> $rqst->get("email"),
                                         'password'=> $rqst->get("password"),'civility'=> $rqst->get("civility"),'enabled'=> true,'roles'=> "ROLE_MEMBER"

                                        ));
            if(!$user){
                return array(
                            'message' => array(
                                'code' => "500",
                                'text' => "Username already taken!",
                            ),
                            'result' => ""
                        );
            }
            $mamberAdress = new Adress();
            $mamberAdress->setAdress($rqst->get('adress'));
            $mamberAdress->setAdressContinued($rqst->get('adresse_contunied'));

            $country = $this->dm
                ->getRepository('CommunBundle\Entity\ListCountry')
                ->find($rqst->get('country'));
            $mamberAdress->setIdCountry($country);

            $region = $this->dm
                ->getRepository('CommunBundle\Entity\ListRegion')
                ->find($rqst->get('region'));
            $mamberAdress->setIdRegion($region);



            $departement = $this->dm
                ->getRepository('CommunBundle\Entity\ListDepartement')
                ->find($rqst->get('departement'));
            $mamberAdress->setIdDepartement($departement);

            $city = $this->dm
                ->getRepository('CommunBundle\Entity\ListCity')
                ->find($rqst->get('city'));
            $mamberAdress->setIdCity($city);

            $mamberAdress->setIdCp($rqst->get('cp'));
            $this->dm->persist($mamberAdress);

            $MemberInfo = new MemberInfo();
            $MemberInfo->setFirstName($rqst->get('firstname'));
            $MemberInfo->setSponsoredMail($rqst->get('emailsponsor'));
            $MemberInfo->setLastName($rqst->get('lastname'));
            $MemberInfo->setBirthDate(new \Datetime($rqst->get('birthdate')));
            $MemberInfo->setMobilePhone($rqst->get('mobilephone'));
            $MemberInfo->setRegisteredNewsletter($rqst->get('registerednewsletter'));
            $MemberInfo->setIdAdress($mamberAdress);     
            $MemberInfo->setIdUser($user);

            if($rqst->get("emailsponsor") && $rqst->get("emailsponsor")!=""){
                $sponsor = $this->userManager->findUserByEmail($rqst->get("email"));
                if($sponsor){
                    $MemberInfo->setIdSponsor($sponsor->getId());
                }
            }

            $this->dm->persist($MemberInfo);
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
                'text' => "Adding completed successfully."
            ),
            'result' => $MemberInfo
        );
           
    }

    /**
     * Update Club  details
     *
     * @param array $clubInfoData
     *
     * @return string $message
     */
    public function updateMemberInfo($reqst)
    {
        
             return false;
    }

    public function findMemberInfoBy(array $args, $one=true)
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

}
