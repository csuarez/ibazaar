<?php

namespace IBazaar\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
     * @Route("/top-descargas", name="app_downloads")
     * @Template()
     */
    public function listByDownloadsAction() {
        $apps = $this->getDoctrine()
                    ->getRepository('IBazaarDataModelBundle:App')
                    ->findOrderedByDownloads(5);

        if (!$apps) {
            throw $this->createNotFoundException('There is not any app in the system');
        }

        return array(
            'apps' => $apps
        );
    }
}
?>