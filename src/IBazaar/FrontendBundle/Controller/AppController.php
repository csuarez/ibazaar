<?php

namespace IBazaar\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Component\HttpFoundation\Request;

class AppController extends Controller
{
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

        $apps = new Pagerfanta(new DoctrineORMAdapter($query));
        $apps->setMaxPerPage(5);

        try {
            $apps->setCurrentPage($page);
        } catch(NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

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

        $apps = new Pagerfanta(new DoctrineORMAdapter($query));
        $apps->setMaxPerPage(5);

        try {
            $apps->setCurrentPage($page);
        } catch(NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

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

        $apps = new Pagerfanta(new DoctrineORMAdapter($query));
        $apps->setMaxPerPage(5);

        try {
            $apps->setCurrentPage($page);
        } catch(NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

        return array(
            'apps' => $apps,
            'term' => $searchTerm
        );
    }
}
?>