<?php

namespace IBazaar\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use IBazaar\FrontendBundle\Utils\Pagination;

class AppController extends Controller
{

    private static $MAX_RESULTS = 5;

    /**
     * @Route("/app/{id}", name="app_profile", requirements={"id" = "\d+"})
     * @Template()
     */
    public function profileAction($id) {
    	$app = $this->getDoctrine()
					->getRepository('IBazaarDataModelBundle:App')
					->findOneById($id);

    	if (!$app) {
    		throw $this->createNotFoundException('This app does not exist.');
    	}

        return array(
        	'app' => $app
        );
    }

    /**
     * @Route("/top-descargas/{page}", name="app_downloads", requirements={"page" = "\d+"}, defaults={"page" = "1"})
     * @Template()
     */
    public function listByDownloadsAction($page) {
        $query = $this->getDoctrine()
                    ->getRepository('IBazaarDataModelBundle:App')
                    ->getQueryForMostDownloaded();

        $apps = Pagination::getPaginatedResults($query, self::$MAX_RESULTS, $page);        

        return array(
            'apps' => $apps
        );
    }

    /**
     * @Route("/nuevas/{page}", name="app_new", requirements={"page" = "\d+"}, defaults={"page" = "1"})
     * @Template()
     */
    public function listByCreationDateAction($page) {
        $query = $this->getDoctrine()
                    ->getRepository('IBazaarDataModelBundle:App')
                    ->getQueryForNewest();

        $apps = Pagination::getPaginatedResults($query, self::$MAX_RESULTS, $page);

        return array(
            'apps' => $apps
        );
    }


    /**
     * @Route("/buscar/{page}", name="app_search", requirements={"page" = "\d+"}, defaults={"page" = "1"})
     * @Template()
     */
    public function searchAction($page, Request $request) {
        $searchTerm = $request->query->get("term");
        $query = $this->getDoctrine()
                    ->getRepository('IBazaarDataModelBundle:App')
                    ->getQueryForSearch($searchTerm);

        $apps = Pagination::getPaginatedResults($query, self::$MAX_RESULTS, $page);
        
        return array(
            'apps' => $apps,
            'term' => $searchTerm
        );
    }
}
?>