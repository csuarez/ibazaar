<?php

namespace IBazaar\DataModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IBazaar\DataModelBundle\Entity\App;
use IBazaar\DataModelBundle\DataFixtures\ORM\CategoryData;
use Faker;

class AppData extends AbstractFixture implements OrderedFixtureInterface {

	public static $MAX_APPS = 100;
	private $faker;

	function __construct() {
		$this->faker = Faker\Factory::create();
	}

	private function getCategories() {
		$categories = array();
		for ($i=0; $i < CategoryData::$MAX_CATEGORIES; $i++) { 
			$category = $this->getReference('category-' . $i);
			$categories[] = $category;
		}
		return $categories;
	}

	private function generateAppName() {
		$name = $this->faker->sentence(rand(1,2)); //With one or two words.
		$name = substr($name, 0, -1); //This removes the final dot.
		$name = ucwords($name);
		return $name;
	}

	public function load(ObjectManager $manager) {
		for ($i = 0; $i <= self::$MAX_APPS; $i++) { 
			$app = new App();
			
			$app
				->setName($this->generateAppName())
				->setDescription($this->faker->paragraph)
				->setPrice($this->faker->randomFloat(1,0,10))
				->setLogoUrl($this->faker->imageUrl(500, 500))
				->setDownloads($this->faker->randomNumber(0,10000))
				->setCreatedAt($this->faker->dateTime());

			//The 33% of the generated apps will be free.
			$isFree = rand(0, 2) == 1; 
			if ($isFree) {
				$app->setPrice(0);
			}

			
			$categories = $this->getCategories();
			
			$categoriesToAdd = rand(1,4);
			$firstCategoryId = rand(0, count($categories) - 1);
			for ($j = 0; $j < $categoriesToAdd; $j++) {
				$categoryIdxToAdd = ($firstCategoryId + $j) % count($categories);
				$app->addCategory($categories[$categoryIdxToAdd]);
			}

			$manager->persist($app);
		}
		$manager->flush();
	}

	public function getOrder() {
		return 2;
	}
}

?>