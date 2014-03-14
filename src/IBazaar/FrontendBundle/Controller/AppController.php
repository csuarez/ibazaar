<?php

namespace IBazaar\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AppController extends Controller
{
    /**
     * @Route("/app/{id}", name="app_profile")
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
}
?>