<?php

namespace IBazaar\FrontendBundle\Utils;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;

class Pagination {

	public static function getPaginatedResults($query, $pageSize, $currentPage) {
		$results = new Pagerfanta(new DoctrineORMAdapter($query));
	    $results->setMaxPerPage($pageSize);

	    try {
	        $results->setCurrentPage($currentPage);
	    } catch(NotValidCurrentPageException $e) {
	        throw new NotFoundHttpException();
	    }

	    return $results;
	}
}
?>