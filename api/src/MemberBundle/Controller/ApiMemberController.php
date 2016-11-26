<?php

namespace MemberBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcherInterface;

class ApiMemberController extends FOSRestController {

    /**
     * Crée un nouveau Membre à partir des données soumises.
     *
     * @ApiDoc(
     *     section="05. services de Membre",
     *   resource = true,
     *      parameters={
     *        {"name"="firstname", "dataType"="string", "required"=true, "description"="firstname"},
     *        {"name"="lastname", "dataType"="string", "required"=true, "description"="lastname"},
     *        {"name"="birthdate", "dataType"="date", "required"=false, "description"="birthdate"},
     *        {"name"="civility", "dataType"="integer", "required"=true, "description"="civility"},
     *        {"name"="adress", "dataType"="string", "required"=true, "description"="adress"},
     *        {"name"="adresse_contunied", "dataType"="string", "required"=true, "description"="adresse_contunied"},
     *        {"name"="country", "dataType"="integer", "required"=true, "description"="country"},
     *        {"name"="region", "dataType"="integer", "required"=true, "description"="region"},
     *        {"name"="departement", "dataType"="integer", "required"=true, "description"="departement"},
     *        {"name"="city", "dataType"="integer", "required"=true, "description"="ville"},
     *        {"name"="cp", "dataType"="integer", "required"=true, "description"="roles"},
     *        {"name"="registerednewsletter", "dataType"="integer", "required"=false, "description"="registerednewsletter"},
     *        {"name"="mobilephone", "dataType"="string", "required"=true, "description"="mobilephone"},
     *        {"name"="password", "dataType"="string", "required"=true, "description"="password"},
     *        {"name"="email", "dataType"="string", "required"=true, "description"="email"},
     *        {"name"="emailsponsor", "dataType"="string", "required"=true, "description"="email"},
     *        {"name"="emailsponsor", "dataType"="string", "required"=false, "description"="email sponsor"},
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
    public function addMemberAction(Request $request)
    {

        $user = $this->get('member.manager')->registerMember($request);

        if($user["message"]["code"] == 200){
			$template    = 'MemberBundle:Email:registermember.html.twig';
            $title       = $this->container->getParameter("sujet_inscript");
            $website     = $this->container->getParameter("website_titre");
            $url_activate= $user['result']->getIdUser()->getConfirmationToken().'/activatcompte';			
			
            $data=array(
                'name'     => $request->get("firstname"),
                'username' => $request->get("email"),
				'email'    => $request->get("email"),
                'password' => $request->get("password"),
                'civility' => $request->get("civility"),
				'url_activate'=> $url_activate,
                'website_url' => $this->container->getParameter("website_url"),
            );
            
            $response = $this->get('mailing.manager')->SendMail($title,$website,$template,$data);
           // return $response;   
        }
        
        return $user;
    }

    /**
     * supprimer un Member.
     *
     * @ApiDoc(
     *     section="05. services de Membre",
     *   resource = true,
     *      parameters={
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
    public function deleteMemberAction(Request $request)
    {

    }

    /**
     * filterMembre liste des Membre.
     *
     * @ApiDoc(
     *     section="05. services de Membre",
     *   resource = true,
     *      parameters={
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
    public function filterMemberAction(Request $request)
    {
        $search_filter=$request->get('search_filter');
        $itemsPerPage=$request->get('item_per_page');
        $pagenumber=$request->get('page_number');

        $member = $this->getDoctrine()
            ->getRepository('MembreBundle:MembreInfo')
            ->filterMembre($search_filter,$itemsPerPage, $pagenumber);

        return $member;

    }

    /**
     * afficher liste des Membre.
     *
     * @ApiDoc(
     *     section="05. services de Membre",
     *   resource = true,
     *      parameters={
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
    public function listMemberAction(Request $request)
    {


    }


    /**
     * afficher un Membre.
     *
     * @ApiDoc(
     *     section="05. services de Membre",
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
    public function showMemberAction($id)
    {

        $member= $this->getDoctrine()
            ->getRepository('MembreBundle:MembreInfo')
            ->find($id);
        return $member;

    }



















}
