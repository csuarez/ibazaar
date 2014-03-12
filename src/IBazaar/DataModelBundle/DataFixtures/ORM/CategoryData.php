<?php

namespace IBazaar\DataModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IBazaar\DataModelBundle\Entity\Category;
use Faker;

class CategoryData extends AbstractFixture implements OrderedFixtureInterface {

	public static $MAX_CATEGORIES = 10;

	private $faker;

	function __construct() {
		$this->faker = Faker\Factory::create();
	}

	public function load(ObjectManager $manager) {
		for ($i = 0; $i <= self::$MAX_CATEGORIES; $i++) { 
			$category = new Category();
			
			$category
				->setName(ucfirst($this->faker->word))
				->setDescription($this->faker->paragraph);

			$manager->persist($category);
			$this->addReference("category-" . $i, $category);
		}

		$manager->flush();
	}

	public function getOrder() {
		return 1;
	}
}

?>