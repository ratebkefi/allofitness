<?php

namespace MemberBundle\Repository;

/**
 * MemberInfoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MemberInfoRepository extends \Doctrine\ORM\EntityRepository
{
    public function filterMember($search_filter,$itemsPerPage, $pagenumber)
    {

        if (isset($search_filter)) {

            $sql = "select member from MemberBundle\Entity\MemberInfo as member where member.firstName LIKE '%" . $search_filter . "%' or ";
           
            $sql .= " member.phone LIKE '%" . $search_filter . "%' or ";
            $sql .= " member.lastName LIKE '%" . $search_filter . "%' or ";
            $sql .= " member.idPackage in (select packages.id from CommunBundle\Entity\ListPackage as packages where packages.name LIKE '%" . $search_filter . "%' ) ";
        }
        else
        {
            $sql = "select member from MemberBundle\Entity\MemberInfo as member ";
        }
        $query = $sql   . "  ";

        $qb = $this->getEntityManager()->createQuery($query)
            // On définit l'annonce à partir de laquelle commencer la liste
            ->setFirstResult(($pagenumber-1) * $itemsPerPage)
            // Ainsi que le nombre d'annonce à afficher sur une page
            ->setMaxResults($itemsPerPage);
        //echo $qb->getSQL(); exit;
        return $qb->getResult();

    }


    public function TotalMember($search_filter)
    {

        if (isset($search_filter)) {
            $sql = "select member from MemberBundle\Entity\MemberInfo as member where member.firstName LIKE '%" . $search_filter . "%' or ";
           
            $sql .= " member.phone LIKE '%" . $search_filter . "%' or ";
            $sql .= " member.lastName LIKE '%" . $search_filter . "%' or ";
            $sql .= " member.idPackage in (select packages.id from CommunBundle\Entity\ListPackage as packages where packages.name LIKE '%" . $search_filter . "%' ) ";
        }
        else
        {
            $sql = "select member from MemberBundle\Entity\MemberInfo as member ";
        }
        $query = $sql   . "  ";

        $qb = $this->getEntityManager()->createQuery($query);
        //echo $qb->getSQL(); exit;
        return count($qb->getResult());

    }
}
