<?php

namespace IBazaar\DataModelBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AppRepository extends EntityRepository {
	public function findOrderedByDownloads($maxResults) {
		$query = $this->createQueryBuilder('a')
			->add('orderBy', 'a.downloads DESC')
			->setMaxResults($maxResults)
			->getQuery();
		return $query->getResult();
	}
}

?>