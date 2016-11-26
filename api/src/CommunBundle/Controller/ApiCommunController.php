<?php

namespace CommunBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcherInterface;
use ClubBundle\Entity\ClubInfo;
use CoachBundle\Entity\CoachInfo;
use UserBundle\Entity\User;

class ApiCommunController extends FOSRestController {



    /**
 * afficher liste des pays.
 *
 * @ApiDoc(
 *     section="04. services de Commun",
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
    public function listCountryAction()
    {
        $dm = $this->getDoctrine()->getManager();
        $country = $dm->getRepository('CommunBundle:ListCountry')->findAll();
        return $country;
    }


    /**
     * afficher liste des civilité.
     *
     * @ApiDoc(
     *     section="04. services de Commun",
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
    public function listCivilityAction()
    {
        $dm = $this->getDoctrine()->getManager();
        $civility= $dm->getRepository('CommunBundle:ListCivility')->findAll();
        return $civility;
    }


    /**
     * afficher liste des 3 dernier club.
     *
     * @ApiDoc(
     *     section="04. services de Commun",
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
    public function lastSubsClubAction()
    {

        $dm = $this->getDoctrine()->getManager();
        $club = $dm->getRepository('ClubBundle:ClubInfo')
            ->findLastClub();
        return $club;

    }

    /**
     * afficher liste des 2 dernier Annonce.
     *
     * @ApiDoc(
     *     section="04. services de Commun",
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

    public function lastAdAction()
    {
        $dm = $this->getDoctrine()->getManager();
        $ad = $dm->getRepository('CommunBundle:ListAd')
            ->findLastAd();
        return $ad;

    }

    /**
     * afficher liste des 3 dernier coach.
     *
     * @ApiDoc(
     *     section="04. services de Commun",
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
    public function lastSubsCoachAction()
    {
        $dm = $this->getDoctrine()->getManager();
        $coach = $dm->getRepository('CoachBundle:CoachInfo')
            ->findLastCoach();
        return $coach;

    }


    /**
     * afficher liste des Superficie.
     *
     * @ApiDoc(
     *     section="04. services de Commun",
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
    public function listAreaAction()
    {
        $dm = $this->getDoctrine()->getManager();
        $country = $dm->getRepository('CommunBundle:ListArea')->findAll();
        return $country;
    }


    /**
     * Afficher liste des region d'un pays.
     *
     * @ApiDoc(
     *     section="04. services de Commun",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function showRegionAction($id) {
        $dm = $this->getDoctrine()->getManager();
        $banque = $dm->getRepository('CommunBundle:ListRegion')->findBy(array('idCountry' => $id));
        return $banque;
    }


    /**
     * Afficher detail d'un Ad.
     *
     * @ApiDoc(
     *     section="04. services de Commun",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function showAdAction($id) {
        $dm = $this->getDoctrine()->getManager();
        $ad = $dm->getRepository('CommunBundle:ListAd')
            ->find($id);
        return $ad;
    }


    /**
     * Afficher liste des departement par region.
     *
     * @ApiDoc(
     *     section="04. services de Commun",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function showDepartementAction($id) {
        $dm = $this->getDoctrine()->getManager();
        $banque = $dm->getRepository('CommunBundle:ListDepartement')->findBy(array('idRegion' => $id));
        return $banque;
    }


    /**
     * Afficher liste des ville par departement.
     *
     * @ApiDoc(
     *     section="04. services de Commun",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function showCityAction($id) {
        $dm = $this->getDoctrine()->getManager();

        $banque = $dm->getRepository('CommunBundle:ListCity')->findListCity($id);
        //$banque = $dm->getRepository('CommunBundle:ListCity')->findBy(array('idDepartement' => $id));
        return $banque;
    }



    /**
     * Afficher liste des types du club.
     *
     * @ApiDoc(
     *     section="04. services de Commun",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function showTypeClubAction() {
        $dm = $this->getDoctrine()->getManager();
        $banque = $dm->getRepository('ClubBundle:ListClubType')->findAll();
        return $banque;
    }


    /**
     * Afficher liste des reseaux du club.
     *
     * @ApiDoc(
     *     section="04. services de Commun",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function showNetworkClubAction() {
        $dm = $this->getDoctrine()->getManager();
        $banque = $dm->getRepository('ClubBundle:ClubNetwork')->findAll();
        return $banque;
    }


    /**
     * Afficher liste des Fonction du club.
     *
     * @ApiDoc(
     *     section="04. services de Commun",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */

    public function showFunctionClubAction() {
        $dm = $this->getDoctrine()->getManager();
        $club = $dm->getRepository('ClubBundle:ListClubFunction')->findAll();
        return $club;
    }

    /**
     * Ajout d'un commantaire + note pour un club/coach
     *
     * @ApiDoc(
     *   section="04. services de Commun",
     *   resource = true,
     *      parameters={
     *      {"name"="club_info", "dataType"="integer", "required"=false, "description"="Id club info"},
     *      {"name"="coach_info", "dataType"="integer", "required"=false, "description"="Id coach info"},
     *      {"name"="text", "dataType"="integer", "required"=true, "description"="Texte du commentaire"},
     *      {"name"="note", "dataType"="integer", "required"=true, "description"="Note et avis client"},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function addCustomerReviewsAction(Request $request)
    {
        $customer_reviews_manager    = $this->get('customer.reviews.manager');
        $validateDataCustomerReviews = $customer_reviews_manager->validateDataCustomerReviews($request);
        
        if (is_array($validateDataCustomerReviews))
        {
            return $validateDataCustomerReviews;
        }
        
        // verif auth & role
        $user_manager = $this->get('user.manager');        
        $current_user = $user_manager->getCurrentUser();
        if ( !is_object($current_user) || is_array($current_user) )
        {
            return $current_user;
        }
        
        return $customer_reviews_manager->addDataCustomerReviews($request, $current_user);
    }
    
    /**
     * Activation d'un commantaire + note client sur club/coach
     *
     * @ApiDoc(
     *   section="04. services de Commun",
     *   resource = true,
     *      parameters={
     *      {"name"="id_customer_reviews", "dataType"="integer", "required"=true, "description"="Id customer reviews"}
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function activateCustomerReviewsAction(Request $request)
    {
        // verif auth & role
        $user_manager = $this->get('user.manager');        
        $current_user = $user_manager->getCurrentUser();
        if ( !is_object($current_user) || is_array($current_user) )
        {
            return $current_user;
        }
        
        $customer_reviews_manager    = $this->get('customer.reviews.manager');
        $activateCustomerReviews = $customer_reviews_manager->activateCustomerReviews($request, $current_user);
        
        if (is_array($activateCustomerReviews) && $activateCustomerReviews['message']['code'] != 200)
        {
            return $activateCustomerReviews;
        }
        
        return $customer_reviews_manager->calculateMyReviews($request);
    }
    
    /**
     * List des commantaires + notes client sur club/coach
     *
     * @ApiDoc(
     *   section="04. services de Commun",
     *   resource = true,
     *      parameters={
     *          {"name"="club_info", "dataType"="integer", "required"=false, "description"="Id club info"},
     *          {"name"="coach_info", "dataType"="integer", "required"=false, "description"="Id coach info"},
     *          {"name"="status", "dataType"="integer", "required"=false, "description"="Status d'événement : 0=En Attente d'activation, 1=Activer, vide=Tous"},
     *     },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function listCustomerReviewsAction(Request $request)
    {
        
        $commun_manager = $this->get('commun.manager');
        $validateDataListCustomerReviews = $commun_manager->validateDataListCustomerReviews($request);        
        if (is_array($validateDataListCustomerReviews))
        {
            return $validateDataListCustomerReviews;
        }
        
        $user_manager = $this->get('user.manager');        
        $current_user = ($user_manager->getCurrentUser() instanceof User) ? $user_manager->getCurrentUser() : null;
        
        $validateStatusListCustomerReviews = $commun_manager->validateStatusListCustomerReviews($request, $current_user);        
        if (is_array($validateStatusListCustomerReviews))
        {
            return $validateStatusListCustomerReviews;
        }
        
        return $commun_manager->listCustomerReviews($request);
    }
    
    /**
     * Liste les événements du mois (pour le club et le coach au même temps).
     *
     * @ApiDoc(
     *   section="04. services de Commun",
     *   resource = true,
     *   requirements={
     *      {"name"="month", "dataType"="string", "requirement"="mm-yyyy", "format"="mm-yyyy", "description"="Mois d'événement"},
     *      {"name"="number", "dataType"="integer", "requirement"="\d+", "description"="Nombre des évenements"},
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
    public function listEventsAction($number, $month, Request $request)
    {
        $request->query->set('number', $number);
        $request->query->set('month', $month);
        
        $commun_manager           = $this->get('commun.manager');
        
        $validateMonth  = $commun_manager->validateMonth($request);        
        if ($validateMonth !== true && is_array($validateMonth)) {
             return $validateMonth;
        }
        
        $validateNumber  = $commun_manager->validateNumber($request);        
        if ($validateNumber !== true && is_array($validateNumber)) {
             return $validateNumber;
        }
        
        return $commun_manager->listEvents($request);
    }
    
    /**
     * Liste les Clubs les mieux notés + les Coachs les mieux notés
     *
     * @ApiDoc(
     *   section="04. services de Commun",
     *   resource = true,
     *   requirements={
     *      {"name"="number", "dataType"="integer", "required"=true, "description"="Nombre des évenements"},
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
    public function listTopRatedClubCoachAction($number, Request $request)
    {
        $commun_manager           = $this->get('commun.manager');
        $request->query->set('number', $number);
        
        $validateNumber  = $commun_manager->validateNumber($request);        
        if ($validateNumber !== true && is_array($validateNumber)) {
             return $validateNumber;
        }
        
        return $commun_manager->getTopRated($request);
    }






    /**
     * modifier etat d'un Annonce.
     *
     * @ApiDoc(
     *
     *      section="04. services de Commun",
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
    public function statusAdAction(Request $request)
    {

        $status=$request->get('status');

        $id=$request->get('id');
        $ad       = $this->get('commun.manager')->statusAd($status,$id);

        return $ad;

    }









}
