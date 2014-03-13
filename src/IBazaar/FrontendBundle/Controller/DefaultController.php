<?php

namespace IBazaar\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
    	$top5AppsByDownloads = $this->getDoctrine()
    						->getRepository('IBazaarDataModelBundle:App')
    						->findOrderedByDownloads(5);

    	if (!$top5AppsByDownloads) {
    		throw $this->createNotFoundException('There is not any app in the system');
    	}

        return array(
        	'top5' => $top5AppsByDownloads
        );
    }
}
