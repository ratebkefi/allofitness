<?php

namespace CoachBundle\Repository;

/**
 * CoachInfoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CoachInfoRepository extends \Doctrine\ORM\EntityRepository
{


    public function findLastCoach($limit = 3)
    {
        $sql = "select coach ";
        $from = " from CoachBundle\Entity\CoachInfo as coach,";
        $where = " where coach.status =1 and";

        $where = substr($where, 0, -4);
        $from = substr($from, 0, -1);
        $query = $sql . $from . $where . " order BY coach.createDat DESC ";
        $qb = $this->getEntityManager()->createQuery($query)
            ->setMaxResults(3);
        return $qb->getResult() ;

    }

    public function filterCoach($search_filter,$itemsPerPage, $pagenumber)
    {
        if (isset($search_filter)) {
            $sql = "select coach from CoachBundle\Entity\CoachInfo as coach where coach.firstName LIKE '%" . $search_filter . "%' ";
            $sql .= " or coach.phone LIKE '%" . $search_filter . "%' ";
            $sql .= " or coach.idUser in (select users.id from UserBundle\Entity\User as users where users.email LIKE '%" . $search_filter . "%') ";
            $sql .= " or coach.idPackage in (select packages.id from CommunBundle\Entity\ListPackage as packages where packages.name LIKE '%" . $search_filter . "%' ) ";
            //$sql="select users.id from UserBundle\Entity\User as users where users.email LIKE '%" .$search_filter. "%'";
            $query = $sql . "  ";
        }
        else
        {
            $sql = "select coach from CoachBundle\Entity\CoachInfo as coach";
        }
        $query = $sql;
        $qb = $this->getEntityManager()->createQuery($query)
             // On définit l'annonce à partir de laquelle commencer la liste
             ->setFirstResult(($pagenumber-1) * $itemsPerPage)
             // Ainsi que le nombre d'annonce à afficher sur une page
             ->setMaxResults($itemsPerPage);
         //echo $qb->getSQL(); exit;
         return $qb->getResult();
    }


    public function TotalCoach($search_filter)
    {
        if (isset($search_filter)) {
            $sql = "select coach from CoachBundle\Entity\CoachInfo as coach where coach.firstName LIKE '%" . $search_filter . "%' ";
            $sql .= " or coach.idUser in (select users.id from UserBundle\Entity\User as users where users.email LIKE '%" . $search_filter . "%') ";
            $sql .= " or coach.idPackage in (select packages.id from CommunBundle\Entity\ListPackage as packages where packages.name LIKE '%" . $search_filter . "%' ) ";
            //$sql="select users.id from UserBundle\Entity\User as users where users.email LIKE '%" .$search_filter. "%'";
            $query = $sql . "  ";
        }
        else
        {
            $sql = "select coach from CoachBundle\Entity\CoachInfo as coach";
        }
        $query = $sql;
        $qb = $this->getEntityManager()->createQuery($query);
        //echo $qb->getSQL(); exit;
        return count($qb->getResult());
    }

    public function findTopRated(array $args = null)
    {
        $query = $this->createQueryBuilder('CI');
        
        // order by
        if (array_key_exists('orderby', $args) && $args['orderby'])
        {
            if (array_key_exists('moyReviews', $args['orderby']))
            {
                $order = ($args['orderby']['moyReviews']) ? $args['orderby']['moyReviews'] : 'ASC';
                $query = $query->orderBy('CI.moyReviews', $order);
            }
        }
        
        // limit
        if (array_key_exists('limit', $args))
        {
            $query = $query->setMaxResults($args['limit']);
        }
        
        return $query->getQuery()->getResult();
    }






    public function filterCourseCoach($search_filter,$itemsPerPage, $pagenumber)
    {
        if (isset($search_filter)) {
            $sql = "select coach from CoachBundle\Entity\CoachInfo as coach where coach.firstName LIKE '%" . $search_filter . "%' ";
            $sql .= " or coach.phone LIKE '%" . $search_filter . "%' ";
            $sql .= " or coach.idUser in (select users.id from UserBundle\Entity\User as users where users.email LIKE '%" . $search_filter . "%') ";
            $sql .= " or coach.idPackage in (select packages.id from CommunBundle\Entity\ListPackage as packages where packages.name LIKE '%" . $search_filter . "%' ) ";
            //$sql="select users.id from UserBundle\Entity\User as users where users.email LIKE '%" .$search_filter. "%'";
            $query = $sql . "  ";
        }
        else
        {
            $sql = "select coach from CoachBundle\Entity\CoachInfo as coach";
        }
        $query = $sql;
        $qb = $this->getEntityManager()->createQuery($query)
            // On définit l'annonce à partir de laquelle commencer la liste
            ->setFirstResult(($pagenumber-1) * $itemsPerPage)
            // Ainsi que le nombre d'annonce à afficher sur une page
            ->setMaxResults($itemsPerPage);
        //echo $qb->getSQL(); exit;
        return $qb->getResult();
    }




















}
