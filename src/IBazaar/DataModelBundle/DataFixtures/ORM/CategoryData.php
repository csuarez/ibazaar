<?php

namespace IBazaar\DataModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IBazaar\DataModelBundle\Entity\Category;
use Faker;

class CategoryData extends AbstractFixture implements OrderedFixtureInterface {

	public static $MAX_CATEGORIES = 10;

	public function load(ObjectManager $manager) {
		$faker = Faker\Factory::create();

		for ($i = 0; $i <= self::$MAX_CATEGORIES; $i++) { 
			$category = new Category();
			
			$category
				->setName(ucfirst(strtolower($faker->word)))
				->setDescription($faker->paragraph);

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