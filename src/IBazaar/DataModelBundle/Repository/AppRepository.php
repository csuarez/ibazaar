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

	public function findOrderedByCreation($maxResults) {
		$query = $this->createQueryBuilder('a')
				->add('orderBy', 'a.createdAt DESC')
				->setMaxResults($maxResults)
				->getQuery();
		return $query->getResult();
	}

	public function getQueryForMostDownloaded() {
		$queryBuilder = $this->createQueryBuilder('a')
						->add('orderBy', 'a.downloads DESC');

		return $queryBuilder;
	}

	public function getQueryForNewest() {
		$queryBuilder = $this->createQueryBuilder('a')
						->add('orderBy', 'a.createdAt DESC');

		return $queryBuilder;
	}

	public function getQueryForSearch($name) {
		$processedName = str_replace(" ", "%", $name);
		$term = '%' . $processedName . '%';

		$queryBuilder = $this->createQueryBuilder('a')
						->where('a.name LIKE :term')
						->setParameter('term', $term);

		return $queryBuilder;
	}
}

?>