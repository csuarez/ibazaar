<?php

namespace IBazaar\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;

class CategoryController extends Controller
{
    /**
     * @Route("/categorias", name="categories_list")
     * @Template()
     */
    public function listAction() {
    	$categories = $this->getDoctrine()
					->getRepository('IBazaarDataModelBundle:Category')
					->findAll();

    	if (!$categories) {
    		throw $this->createNotFoundException('No categories?!');
    	}

        return array(
        	'categories' => $categories
        );
    }
}
?>