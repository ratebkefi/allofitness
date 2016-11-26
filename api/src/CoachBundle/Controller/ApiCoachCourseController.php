<?php

namespace CoachBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcherInterface;;

class ApiCoachCourseController extends FOSRestController
{


    /**
     * Crée un nouveau cour .
     *
     * @ApiDoc(
     *     section="03. services de Coach",
     *   resource = true,
     *      parameters={
     *      {"name"="id_coach", "dataType"="integer", "required"=true, "description"="id_coach"},
     *      {"name"="id_course_category", "dataType"="integer", "required"=true, "description"="id_course_category"},
     *      {"name"="id_movementRange", "dataType"="integer", "required"=true, "description"="id_movementRange"},
     *      {"name"="experience", "dataType"="string", "required"=true, "description"="experience"},
     *      {"name"="diploma", "dataType"="array(integer)", "required"=true, "description"="diploma"},
     *     {"name"="place", "dataType"="array(integer)", "required"=true, "description"="place"},
     *     {"name"="primary_objective", "dataType"="array(integer)", "required"=true, "description"="primary_objective"},
     *     {"name"="id_number_of_persons", "dataType"="array(integer)", "required"=true, "description"="id_number_of_persons"},
     *     {"name"="service_approval", "dataType"="boolean", "required"=true, "description"="service_approval"},
     *     {"name"="price", "dataType"="integer", "required"=true, "description"="price"},
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

    public function addCourseAction(Request $request)
    {

        $params = array(
            'id_coach' => $request->get('id_coach'),
            'id_course_category' => $request->get('id_course_category'),
            'id_movementRange' => $request->get('id_movementRange'),
            'experience' => $request->get('experience'),
            'diploma'=> json_decode($request->get('diploma')) ,
            'place'=> json_decode($request->get('place')),
            'primary_objective'=> json_decode($request->get('primary_objective')),
            'id_number_of_persons'=> json_decode($request->get('id_number_of_persons')),
            'service_approval'=> $request->get('service_approval'),
            'price'=> $request->get('price')
        );

        $course = $this->get('coach.manager')->registerCourseCoach($params);
        return $course;

    }


    /**
     * modifier un nouveau cour .
     *
     * @ApiDoc(
     *     section="03. services de Coach",
     *   resource = true,
     *      parameters={
     *      {"name"="id", "dataType"="integer", "required"=true, "description"="id"},
     *      {"name"="id_course_category", "dataType"="integer", "required"=true, "description"="id_course_category"},
     *      {"name"="id_movementRange", "dataType"="integer", "required"=true, "description"="id_movementRange"},
     *      {"name"="experience", "dataType"="string", "required"=true, "description"="experience"},
     *      {"name"="diploma", "dataType"="array(integer)", "required"=true, "description"="diploma"},
     *     {"name"="place", "dataType"="array(integer)", "required"=true, "description"="place"},
     *     {"name"="primary_objective", "dataType"="array(integer)", "required"=true, "description"="primary_objective"},
     *     {"name"="id_number_of_persons", "dataType"="array(integer)", "required"=true, "description"="id_number_of_persons"},
     *     {"name"="service_approval", "dataType"="boolean", "required"=true, "description"="service_approval"},
     *     {"name"="price", "dataType"="integer", "required"=true, "description"="price"},
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

    public function updateCourseAction(Request $request)
    {

        $params = array(
            'id' => $request->get('id'),
            'id_course_category' => $request->get('id_course_category'),
            'id_movementRange' => $request->get('id_movementRange'),
            'experience' => $request->get('experience'),
            'diploma'=> json_decode($request->get('diploma')) ,
            'place'=> json_decode($request->get('place')),
            'primary_objective'=> json_decode($request->get('primary_objective')),
            'id_number_of_persons'=> json_decode($request->get('id_number_of_persons')),
            'service_approval'=> $request->get('service_approval'),
            'price'=> $request->get('price')
        );

        $course = $this->get('coach.manager')->updateCourseCoach($params);
        return $course;

    }




    /**
     * afficher liste des Cours par Coach.
     *
     * @ApiDoc(
     *     section="03. services de Coach",
     *   resource = true,
     *      parameters={
     *         {"name"="item_per_page", "dataType"="string", "required"=true, "description"="item par page"},
     *        {"name"="page_number", "dataType"="string", "required"=true, "description"="nombre du page"},
     *       {"name"="id_coach", "dataType"="integer", "required"=true, "description"="id_coach"},
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

    public function showCourseCoachAction(Request $request)
    {

        $itemsPerPage=$request->get('item_per_page');
        $pagenumber=$request->get('page_number');
        $idCoach=$request->get('id_coach');

        $course = $this->getDoctrine()
            ->getRepository('CoachBundle:CoachCourse')
            ->filterCoach($idCoach,$itemsPerPage, $pagenumber);

        return $course;

    }

        /**
         * total cours de Coach.
         *
         * @ApiDoc(
         *     section="03. services de Coach",
         *   resource = true,
         *      parameters={
         *         {"name"="id_coach", "dataType"="integer", "required"=true, "description"="id_coach"},
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

        public function totalCourseCoachAction(Request $request)
        {
            $idCoach=$request->get('id_coach');
            $coach = $this->getDoctrine()
                ->getRepository('CoachBundle:CoachCourse')
                ->TotalCourseCoach($idCoach);

            return $coach;

        }


    /**
     * afficher liste des Cours .
     *
     * @ApiDoc(
     *     section="03. services de Coach",
     *   resource = true,
     *      parameters={
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



    public function showCourseAction(Request $request)
    {

        $itemsPerPage=$request->get('item_per_page');
        $pagenumber=$request->get('page_number');


        $course = $this->getDoctrine()
            ->getRepository('CoachBundle:CoachCourse')
            ->filterCourse($itemsPerPage, $pagenumber);

        return $course;

    }

    /**
     * total cours .
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

    public function totalCourseAction(Request $request)
    {

        $coach = $this->getDoctrine()
            ->getRepository('CoachBundle:CoachCourse')
            ->TotalCourse();
        return $coach;

    }


    /**
     * valider un nouveau cour .
     *
     * @ApiDoc(
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

    public function validateCourseAction(Request $request)
    {

        $status=$request->get('status');
        $id=$request->get('id');

        $cours        = $this->get('coach.manager')->statusCourse($status,$id);

        return $cours;

    }


    /**
     * filtre liste des Coach.
     *
     * @ApiDoc(
     *     section="03. services de Coach",
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

    public function filterCourseCoachAction(Request $request)
    {

        $search_filter=$request->get('search_filter');
        $itemsPerPage=$request->get('item_per_page');
        $pagenumber=$request->get('page_number');

        $coach = $this->getDoctrine()
            ->getRepository('CoachBundle:CoachInfo')
            ->filterCourseCoach($search_filter,$itemsPerPage, $pagenumber);

        return $coach;

    }











}
