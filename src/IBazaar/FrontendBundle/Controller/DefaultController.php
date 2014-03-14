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
    	$mostDownloadedApps = $this->getDoctrine()
    						->getRepository('IBazaarDataModelBundle:App')
    						->findOrderedByDownloads(5);

    	$lastApps = $this->getDoctrine()
    						->getRepository('IBazaarDataModelBundle:App')
    						->findOrderedByCreation(5);


    	if ((!$mostDownloadedApps) || (!$lastApps)) {
    		throw $this->createNotFoundException('There is not any app in the system');
    	}

    	$categories = $this->getDoctrine()
    						->getRepository('IBazaarDataModelBundle:Category')
    						->findN(8);

        return array(
        	'mostDownloadedApps' 	=> $mostDownloadedApps,
        	'lastApps' 				=> $lastApps,
        	'categories' 			=> $categories
        );
    }
}
?>