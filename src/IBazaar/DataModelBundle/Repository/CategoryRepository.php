<?php

namespace IBazaar\DataModelBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository {
	public function findN($maxResults) {
		$query = $this->createQueryBuilder('c')
			->setMaxResults($maxResults)
			->getQuery();
		return $query->getResult();
	}
}

?>