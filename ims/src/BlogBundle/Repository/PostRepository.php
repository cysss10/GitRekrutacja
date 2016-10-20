<?php

namespace BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;


class PostRepository extends EntityRepository
{

    public function getPublishedPost($slug){

        $qb = $this->getQueryBuilder()
            ->select('p')
            ->Where('p.slug = :slug')
            ->setParameter('slug', $slug);

        return $qb->getQuery()->getOneOrNullResult();

    }

    public function getQueryBuilder(array $params = array()){

        $qb = $this->createQueryBuilder('p')
                    ->select('p');

        if(!empty($params['orderBy'])){
            $orderDir = !empty($params['orderDir']) ? $params['orderDir'] : NULL;
            $qb -> orderBy($params['orderBy'], $orderDir);
        }

        return $qb;
    }
}