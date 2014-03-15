<?php

namespace IBazaar\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IBazaar\FrontendBundle\Utils\Pagination;

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

    /**
     * @Route("/categoria/{id}/{page}", name="category_profile", requirements={"page" = "\d+", "id" = "\d+"}, defaults={"page" = "1"})
     * @Template()
     */
    public function profileAction($id, $page) {
        $category = $this->getDoctrine()
                    ->getRepository('IBazaarDataModelBundle:Category')
                    ->findOneById($id);

        if (!$category) {
            throw $this->createNotFoundException('This category does not exist.');
        }

        $query = $this->getDoctrine()
                    ->getRepository('IBazaarDataModelBundle:App')
                    ->getQueryByCategory($id);

        $apps = Pagination::getPaginatedResults($query, 5, $page);

        return array(
            'apps' => $apps,
            'category' => $category
        );
    }
}
?>